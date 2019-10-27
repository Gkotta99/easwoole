<?php
/**
 * Created by PhpStorm.
 * User: bo
 * Date: 2019/10/5
 * Time: 23:54
 */
namespace App\Lib\Es;

use EasySwoole\Core\AbstractInterface\Singleton;
use EasySwoole\Core\Component\Di;
use Elasticsearch\ClientBuilder;

class Escilent
{
    use Singleton;
    public $Esclient = null;
    private function __construct()
    {
        $config = \Yaconf::get('es');
        try{
            $this->Esclient = ClientBuilder::create()->setHosts([$config['host'].":".$config['port']])->build();
        }catch (\Exception $e){
            throw new\Exception('es服务出错');
        }
        if(empty($this->Esclient)){
            throw new\Exception('es链接失败');
        }
    }
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return $this->Esclient->$name(...$arguments);
    }
}