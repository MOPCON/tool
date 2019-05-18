<?php

namespace App\Commands\Notifier;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use GuzzleHttp\Client;

class LeadersCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'notify:leaders';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'copy meeting minute template and send slack notificaiton.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $meetingTimestame = strtotime('next tuesday');

        $google_client = $this->getGoogleClient();
        $service = new \Google_Service_Drive($google_client);
        $postBody = new \Google_Service_Drive_DriveFile([
            'name' => date('Y-m-d', $meetingTimestame),
        ]);
        $newFile = $service->files->copy(env('DOC_TEMPLATE_ID'), $postBody);
        $this->info(sprintf("file copied. Name: %s", $newFile->name));

        $msg = sprintf(
            "<!here|here> 本週 %s（二）21:00 - 22:00 會議記錄，如有工作進度及需議決事項請至上面填寫哦~\n<https://docs.google.com/document/d/%s/edit>",
            date('m-d', $meetingTimestame),
            $newFile->id
        );
        $json = [
            'text' => $msg,
        ];

        $response = (new Client())->request(
            'POST',
            env('SLACK_LEADERS_WEBHOOK'),
            ['json' => $json]
        );

        if($response->getBody() == 'ok'){
            $this->info('slack message sent.');
        }

    }
    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    protected function getGoogleClient()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path() . env('SECRET_FOLDER') . env('GOOGLE_SERVICE_CRENDENTIALS'));

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APP_NAME'));
        $client->setScopes(\Google_Service_Drive::DRIVE);
        $client->useApplicationDefaultCredentials();

        return $client;
    }
}
