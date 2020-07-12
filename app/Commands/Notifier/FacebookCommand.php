<?php

namespace App\Commands\Notifier;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class FacebookCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'notify:facebook';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'notify teams to share new facebook post.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $log_path = env("FACEBOOK_LATEST_POST_LOG_PATH", 'logs/latest-notified-post.log');
        $query = "fields=feed.limit(" . env('FACEBOOK_POST_LIMIT', 1) . ")";
        $query .= urlencode("{permalink_url,created_time}");
        $url = "https://graph.facebook.com/v7.0/mopcon?" . $query . "&access_token=" . env('FACEBOOK_ACCESS_TOKEN');

        try {
            $fbRequest = (new Client())->request(
                'GET',
                $url,
                ['timeout' => 1]
            );
            $fbResponse = json_decode((string) $fbRequest->getBody(), true);
            $fbData = $fbResponse['feed']['data'];

            $log = file_exists(storage_path($log_path)) ? json_decode(file_get_contents(storage_path($log_path)), true) : [];
            $outputPost = [];
            if (!empty($log)) {
                $lastData = $log[0];
                foreach ($fbData as $post) {
                    if ($post['id'] === $lastData['id']) {
                        continue;
                    }
                    if (strtotime($post['created_time']) < strtotime($lastData['created_time'])) {
                        continue;
                    }
                    $outputPost[] = $post;
                }
            } else {
                $outputPost = $fbData;
            }

            if (!empty($outputPost)) {
                $postUrls = array_column($outputPost, 'permalink_url');
                $msg = "<!here|here> 今天，你 MOPCON 了嗎？想來點讚和分享嗎？粉專最新動態，舉手之勞流量之寶。\n" . implode("\n", $postUrls);
                $json = [
                    'text' => $msg,
                ];

                $response = (new Client())->request(
                    'POST',
                    env('SLACK_FACEBOOK_WEBHOOK'),
                    ['json' => $json]
                );

                if ($response->getBody() === 'ok') {
                    $this->info($this->signature . ': done');
                    Log::info($this->signature . ': done');
                    file_put_contents(storage_path($log_path), json_encode(array_values($outputPost), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                }
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                Log::error('Failure response :' . Psr7\str($e->getResponse()));
                Log::error('Failure request :' . Psr7\str($e->getRequest()));
            }
        }
    }
}
