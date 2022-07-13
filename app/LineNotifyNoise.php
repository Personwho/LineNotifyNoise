<?php

namespace App;

use GuzzleHttp\Client;

class LineNotifyNoise
{
    // 傳送訊息
    public $message;

    // Line Notify API token
    public $token;

    // 傳送間隔
    public $interval = 0;

    public function __construct(string $token, int $interval)
    {
        $this->token = $token;
        $this->interval = $interval * 1000;
    }

    /**
     * 貼圖的 stickerPackageId, stickerId 下面網址查找.
     *
     * @see https://developers.line.biz/en/docs/messaging-api/sticker-list/#specify-sticker-in-message-object
     */
    public function run(string $message = null, int $stickerPackageId = null, int $stickerId = null)
    {
        while (1) {
            $this->sendMessage($message, $stickerPackageId, $stickerId);
            usleep($this->interval);
        }
    }

    public function sendMessage(string $message = null, int $stickerPackageId = null, int $stickerId = null)
    {
        $url = "https://notify-api.line.me/api/notify?message=$message"
                ."&stickerPackageId=$stickerPackageId"
                ."&stickerId=$stickerId";

        $client = new Client([
            'timeout' => 2.0,
        ]);

        return $client->post($url, [
            'headers' => ['Authorization' => 'Bearer '.$this->token],
        ]);
    }
}
