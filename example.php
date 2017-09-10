<?php

require __DIR__ . '/vendor/autoload.php';

use Qbhy\QrCodeScanner\QrCodeScanner;

$qrCode = new QrCodeScanner('./qr.png');  //图片路径
$text = $qrCode->text(); //返回识别后的文本
echo $text . PHP_EOL;