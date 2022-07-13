<?php

use App\LineNotifyNoise;
use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

// 預設值
// 傳送訊息
$message = env('MESSAGE', 'empty');
// Line Notify api token
$token = env('TOKEN');
// 貼圖包ID
$stickerPackageId = env('STICKERPACKAGEID');
// 貼圖ID
$stickerId = env('STICKERID');
// 傳送間隔(毫秒)
$interval = env('INTERVAL');

echo '輸入token('.(empty($token) ? '必填' : $token).'):';
$token = trim(fgets(STDIN)) ?: $token;
if (!$token) {
    exit;
}
echo "輸入訊息($message):";
$temp = trim(fgets(STDIN));
$message = !empty($temp) ? $temp : $message;
echo "輸入貼圖包ID($stickerPackageId):";
$stickerPackageId = (int) trim(fgets(STDIN)) ?: $stickerPackageId;
echo "輸入貼圖ID($stickerId):";
$stickerId = (int) trim(fgets(STDIN)) ?: $stickerId;
echo "輸入傳送間隔($interval):";
$interval = (int) trim(fgets(STDIN)) ?: $interval;

// 建立Line Notify
$lineNotify = new LineNotifyNoise($token, $interval);

// 開始發送訊息
$lineNotify->run($message, $stickerPackageId, $stickerId);
