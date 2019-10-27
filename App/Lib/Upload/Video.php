<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/27 0027
 * Time: 11:55
 */

namespace App\Lib\Upload;

use App\Lib\Upload\Base;

class Video extends Base
{
    public $filetype = "video";
    public $maxsize = 122;
    public $fileExtTpye = [
        'mp4',
    ];
}