<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/27 0027
 * Time: 11:55
 */

namespace App\Lib\Upload;
use App\Lib\Utils;
class Base
{
    public $type = '';
    public $size = '';
    public $info = [];
    public function __construct($request,$type=null)
    {
        $this->request = $request;
        $files = $this->request->getSwooleRequest()->files;
        $this->info = $files;
        $types = array_keys($files);
        $this->type = $types[0];
    }
    public function upload(){
        if($this->type != $this->filetype){
            return false;
        }
        $video = $this->request->getUploadedFile($this->type);
        $this->size = $this->info[$this->type]['size'];
        $this->checkSize();
        $this->checkType();
        $file = $this->getfile($this->info[$this->type]['name']);
        $flag = $video->moveTo($file);
        if(!empty($flag)){
            return $this->file;
        }
        return false;

    }
    public function getfile(){
        $pathinfo = pathinfo($this->info[$this->type]['name']);
        $extension = $pathinfo['extension'];
        $dirname = "/".$this->type."/".date("Y")."/".date("m");
        $dir = EASYSWOOLE_ROOT . "/webroot" . $dirname;
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        $basename = "/" . Utils::getFileKey($this->info[$this->type]['name']).".".$extension;
        $this->file  = $dirname .$basename;
        return $dir.$basename;
    }
    public function checkType(){
        $ciltype = explode('/',$this->info[$this->type]['type']);
        $ciltype = $ciltype[1] ?? "";
        //print_r($ciltype);
        if(empty($ciltype)){
            throw new \Exception('文件不合法');
        }
        if(!in_array($ciltype,$this->fileExtTpye)){
            throw new \Exception('文件不合法');
        }
        return true;
    }
    public function checkSize(){
        if(empty($this->size)){
            return false;
        }
    }
}