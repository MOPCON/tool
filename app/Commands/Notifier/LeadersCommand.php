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
        if (!$this->checkTime()) {
            Log::debug('[' . $this->signature . '] 未發送紀錄 :');
            Log::debug('[' . $this->signature . '] 時區 => ' .  date_default_timezone_get());
            Log::debug('[' . $this->signature . '] 現在日期 => ' . date('Y-m-d'));
            Log::debug('[' . $this->signature . '] 基準日 => ' . env('BENCHMARK_DATE', '2020-07-19'));
            exit;
        }

        $meetingTimestamp = strtotime('next tuesday');

        $google_client = $this->getGoogleClient();
        $service = new \Google_Service_Drive($google_client);
        $postBody = new \Google_Service_Drive_DriveFile([
            'name' => date('Ymd', $meetingTimestamp) . '組長會議',
        ]);
        $newFile = $service->files->copy(env('DOC_TEMPLATE_ID'), $postBody);
        $log_msg = sprintf("file copied. Name: %s", $newFile->name);
        $this->info($log_msg);
        Log::info($log_msg);


        $msg = sprintf(
            "<!here|here> 本週 %s（二）21:30 - 22:30 會議記錄，如有工作進度及需議決事項請至上面填寫哦~\n<https://docs.google.com/document/d/%s/edit>",
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

    protected function checkTime()
    {
        $benchmark_date = env('BENCHMARK_DATE', '2020-07-19');
        $benchmark = (int) strtotime($benchmark_date);
        $today = (int) strtotime(date('Y-m-d'));

        $period = 1209600; // 2*7*24*60*60
        $difference = $today - $benchmark;
        return (is_int($difference/$period));
    }
}
