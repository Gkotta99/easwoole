<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/26 0026
 * Time: 10:29
 */

namespace App\Api;

use App\HttpController\Base;
use EasySwoole\Core\Component\Di;

class Upload extends Base
{
    public function file(){
        $request = $this->request();
        $file = $request->getUploadedFile('file');
        $move = $file->moveTo("/www/wwwroot/easyswoole2/webroot/1.mp4");
        var_dump($move);
            'code' => 200,
            'url' => '/1.mp4',
        ];
        if($move){
            return $this->writeJson(200,'success',$data);
        }else{
            return $this->writeJson(400,'fail');
        }
    }
}