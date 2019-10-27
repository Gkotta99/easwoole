<?php


namespace App\HttpController\Api;
use App\HttpController\Base;
use App\Model\Video as VideoModel;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Swoole\Task\TaskManager;

class Index extends Base
{
    public function getIndexData(){
        $par = $this->request()->getRequestParam();
        $page = !empty($par['page']) ? intval($par['page']) : 1;
        $size = !empty($par['size']) ? intval($par['size']) : 5;
//        try{
//            $vi = new VideoModel();
//            $list = $vi->getVideo([],$page,$size);
//        }catch (\Exception $e){
//            return $this->writeJson(400,'ERROR',$e->getMessage());
//        }
        $data = Di::getInstance()->get("REDIS")->get('cat_id0');
        //print_r($data);
//        return $this->writeJson(200,'SUCCESS',$list);
    }
    public function test(){
        TaskManager::async(function(){
            Di::getInstance()->get("REDIS")->zIncrBy('show_num',1,2);
        });
        return $this->writeJson(200,'SUCCESS',[]);
    }
    public function sorck(){
        $data = Di::getInstance()->get("REDIS")->zrange('show_num',0,-1,"withscres");
        print_r($data);
    }
}