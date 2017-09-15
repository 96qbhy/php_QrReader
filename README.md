# qrcode-scanner
二维码扫描仪

> 该项目不再维护，转战至 [code-scanner](https://github.com/96qbhy/code-scanner-php) , `code-scanner` 支持二维码和条形码的扫描，欢迎 star。  
> 该项目不再维护，转战至 [code-scanner](https://github.com/96qbhy/code-scanner-php) , `code-scanner` 支持二维码和条形码的扫描，欢迎 star。  
> 该项目不再维护，转战至 [code-scanner](https://github.com/96qbhy/code-scanner-php) , `code-scanner` 支持二维码和条形码的扫描，欢迎 star。

## 需要
```
PHP >= 5.3
GD Library
```

## 安装
```bash
composer require 96qbhy/qrcode-scanner
```

## 使用
```php
require __DIR__ . '/vendor/autoload.php';

use Qbhy\QrCodeScanner\QrCodeScanner;

$qrCode = new QrCodeScanner('./qr.png');  //图片路径
$text = $qrCode->text(); //返回识别后的文本
echo $text . PHP_EOL;
```

## 版权声明
此包并非完全由我书写，而是 fork 自 [https://github.com/baagee/php_QrReader](https://github.com/baagee/php_QrReader) 后修改而来。由于原版本不支持 `composer`， 故有了此包。

96qbhy@gmail.com  
[https://github.com/96qbhy/qrcode-scanner](https://github.com/96qbhy/qrcode-scanner)