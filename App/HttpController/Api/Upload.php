<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/26 0026
 * Time: 10:29
 */

namespace App\HttpController\Api;

use App\HttpController\Base;
//use EasySwoole\Core\Component\Di;
use App\Lib\ClassArr;

class Upload extends Base
{
    public function file(){
        $request = $this->request();
        $files = $request->getSwooleRequest()->files;
        $types = array_keys($files);
        $type = $types[0];
        if(empty($type)) {
            return $this->writeJson(400, '上传文件不合法');
        }
        try{
            $classObj = new ClassArr();
            $classStats = $classObj->uploadClassStat();
            $uploadObj = $classObj->initClass($type, $classStats, [$request, $type]);
            $file = $uploadObj->upload();
        }catch (\Exception $e){
            return $this->writeJson(400,$e->getMessage(),[]);
        }
        if(empty($file)){
            return $this->writeJson(400,'上传失败',[]);
        }
        $data = [
          'url' => $file,
        ];
        return $this->writeJson(200,'上传成功',$data);
    }
}