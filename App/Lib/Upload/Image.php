<?php


namespace App\Lib\Upload;

use App\Lib\Upload\Base;

class Image extends Base
{
    public $filetype = "image";
    public $maxsize = 122;
    public $fileExtTpye = [
        'jpg',
        'png',
        'jpeg',
    ];
}