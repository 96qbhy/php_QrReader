<?php

namespace Qbhy\QrCodeScanner;


interface Reader {

    public function decode($image);


    public  function reset();


}