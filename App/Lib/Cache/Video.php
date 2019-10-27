<?php


namespace App\Lib\Cache;
use App\Model\Video as VideoModel;
use EasySwoole\Core\Component\Di;

class Video
{
    public function setIndexVideo(){
        $cate =  array_keys(\Yaconf::get("category.cate"));
        array_unshift($cate,0);
        $obj = new VideoModel();
        foreach($cate as $item){
            $condition = [];
            if(!empty($item)){
                $condition['cat_id'] = $item;
            }
            try{
                $data = $obj->getCacheVideo($condition);
            }catch (\Exception $e){
                $data = [];
            }
            if(empty($data)){
                continue;
            }
            Di::getInstance()->get("REDIS")->set('cat_id'.$item,json_encode($data));

//            $falg = file_put_contents(EASYSWOOLE_ROOT."/webroot/json/".$item.".json",json_encode($data));
//            if(!empty($falg)){
//                echo "success";
//            }else{
//                echo "error";
//            }
        }

    }

}