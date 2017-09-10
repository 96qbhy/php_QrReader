<?php

namespace Qbhy\QrCodeScanner;


use Qbhy\QrCodeScanner\Common\HybridBinarizer;
use Qbhy\QrCodeScanner\Qrcode\QRCodeReader;

final class QrCodeScanner
{
    const SOURCE_TYPE_FILE = 'file';
    const SOURCE_TYPE_BLOB = 'blob';
    const SOURCE_TYPE_RESOURCE = 'resource';

    public $result;

    function __construct($imgsource, $sourcetype = QrCodeScanner::SOURCE_TYPE_FILE, $isUseImagickIfAvailable = true)
    {

        try {
            switch ($sourcetype) {
                case QrCodeScanner::SOURCE_TYPE_FILE:
                    if ($isUseImagickIfAvailable && extension_loaded('imagick')) {
                        $im = new Imagick();
                        $im->readImage($imgsource);
                    } else {
                        $image = file_get_contents($imgsource);
                        $im = imagecreatefromstring($image);
                    }

                    break;

                case QrCodeScanner::SOURCE_TYPE_BLOB:
                    if ($isUseImagickIfAvailable && extension_loaded('imagick')) {
                        $im = new Imagick();
                        $im->readimageblob($imgsource);
                    } else {
                        $im = imagecreatefromstring($imgsource);
                    }

                    break;

                case QrCodeScanner::SOURCE_TYPE_RESOURCE:
                    $im = $imgsource;
                    if ($isUseImagickIfAvailable && extension_loaded('imagick')) {
                        $isUseImagickIfAvailable = true;
                    } else {
                        $isUseImagickIfAvailable = false;
                    }

                    break;
            }

            if ($isUseImagickIfAvailable && extension_loaded('imagick')) {
                $width = $im->getImageWidth();
                $height = $im->getImageHeight();
                $source = new IMagickLuminanceSource($im, $width, $height);
            } else {
                $width = imagesx($im);
                $height = imagesy($im);
                $source = new GDLuminanceSource($im, $width, $height);
            }
            $histo = new HybridBinarizer($source);
            $bitmap = new BinaryBitmap($histo);
            $reader = new QRCodeReader();

            $this->result = $reader->decode($bitmap);
        } catch (NotFoundException $er) {
            $this->result = false;
        } catch (FormatException $er) {
            $this->result = false;
        } catch (ChecksumException $er) {
            $this->result = false;
        }
    }

    public function text()
    {
        if (method_exists($this->result, 'toString')) {
            return ($this->result->toString());
        } else {
            return $this->result;
        }
    }

    public function decode()
    {
        return $this->text();
    }
}

