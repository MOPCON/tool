<?php

namespace App\Commands\Notifier;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
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
        $meetingTimestamp = strtotime('next tuesday');

        $google_client = $this->getGoogleClient();
        $service = new \Google_Service_Drive($google_client);
        $postBody = new \Google_Service_Drive_DriveFile([
            'name' => date('Y-m-d', $meetingTimestamp),
        ]);
        $newFile = $service->files->copy(env('DOC_TEMPLATE_ID'), $postBody);
        $log_msg = sprintf("file copied. Name: %s", $newFile->name);
        $this->info($log_msg);
        Log::info($log_msg);


        $msg = sprintf(
            "<!here|here> 本週 %s（二）21:00 - 22:00 會議記錄，如有工作進度及需議決事項請至上面填寫哦~\n<https://docs.google.com/document/d/%s/edit>",
            date('m-d', $meetingTimestamp),
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

        if ($response->getBody() == 'ok') {
            $this->info($this->signature . ': done');
            Log::info($this->signature . ': done');
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
        $schedule->command(static::class)->weeklyOn(0, '0:00');
    }

    protected function getGoogleClient()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path() . env('SECRET_FOLDER') . env('GOOGLE_SERVICE_CREDENTIALS'));

        $client = new \Google_Client();
        $client->setApplicationName(env('APP_NAME'));
        $client->setScopes([
            \Google_Service_Drive::DRIVE_READONLY,
            \Google_Service_Drive::DRIVE_FILE,
        ]);
        $client->useApplicationDefaultCredentials();

        return $client;
    }
}
