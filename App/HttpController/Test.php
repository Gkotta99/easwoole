<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/13 0013
 * Time: 18:28
 */

namespace App\HttpController;

use App\HttpController\Base;
use App\Lib\Redis\Redis;
use \EasySwoole\Core\Component\Di;

class Test extends Base
{
    public function setRedis(){
        $data = Di::getInstance()->get('REDIS')->set('name','joker');
    }
    public function getRedis(){
        $data = Di::getInstance()->get('REDIS')->get('name');
        $this->writeJson(200,'获取成功',$data);
    }
    public function pub(){
        $parms = $this->request()->getRequestParam();
        Di::getInstance()->get('REDIS')->rPush('test_list',$parms['f']);
    }
    
}