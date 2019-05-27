<?php

namespace App\Commands\Notifier;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;
use GuzzleHttp\Client;

class InfoTeamCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'notify:infoteam';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'notify info team to report sprint progress.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $msg = <<<EOT
<!channel>
Hi All, 提醒大家每週五所有成員要回報目前進度喔，格式如下：
組別： xxxx
這週做了：
    1. xxxxx
    2. xxxxx
下週要做：
    1. xxxxx
    2. xxxxx
遇到什麼問題：
    1. xxxxx
    2. xxxxx
EOT;

        $response = (new Client())->request(
            'POST',
            env('SLACK_INFOTEAM_WEBHOOK'),
            ['json' => ['text' => $msg]]
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
        $schedule->command(static::class)->weeklyOn(0, '9:00');
    }
}
