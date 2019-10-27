<?php


namespace App\HttpController\Api;
use App\Model\Video as VideoModel;
use App\HttpController\Base;

class Video extends Base
{
    public function add(){
        $parms = $this->request()->getRequestParam();
        $data = [
            'name' => $parms['name'],
        ];
        try{
            $obj = new VideoModel();
            $into = $obj->add($data);
        }catch (\Exception $e){
            return $this->writeJson('400',$e->getMessage());
        }
        if(!empty($into)){
            return $this->writeJson(200,'SUCCESS',$into);
        }else{
            return $this->writeJson(400,'ERROR',[]);
        }
    }
}