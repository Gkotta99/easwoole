<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 2019/8/14
 * Time: 23:03
 */

namespace App\Lib\Redis;

use EasySwoole\Core\AbstractInterface\Singleton;

class Redis
{
    use Singleton;
    private $redis = '';
    public function __construct()
    {
        try{
            $redisConfig = \Yaconf::get('redis');
            $this->redis = new \Redis();
            $reulst = $this->redis->connect($redisConfig['host'],$redisConfig['port'],$redisConfig['time_out']);
        }catch (\Exception $e){
            throw new \Exception('redis服务出错');
        }
        if( $reulst === false){
            throw new \Exception('redis链接失败');
        }
    }
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return $this->redis->$name(...$arguments);
    }
}