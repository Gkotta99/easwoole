<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Lib\Redis\Redis;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use \EasySwoole\Core\Component\Di;
use App\Lib\Process\ConsumerTest;
use EasySwoole\Core\Swoole\Process\ProcessManager;
use App\Lib\Cache\Video;
use EasySwoole\Core\Swoole\Time\Timer;
use App\Model\Video as VideoModel;
use App\Lib\Es\Escilent;

Class EasySwooleEvent implements EventInterface {

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(ServerManager $server,EventRegister $register): void
    {
        Di::getInstance()->set('MYSQL',\MysqliDb::class,Array (
                'host' => '106.12.76.185',
                'username' => 'root',
                'password' => '5db7fc47188f64c9',
                'db'=> 'test',
                'port' => 3306,
                'charset' => 'utf8')
        );
        Di::getInstance()->set('REDIS',Redis::getInstance());
        Di::getInstance()->set('ES',Escilent::getInstance());
        $allNum = 3;
        for ($i = 0 ;$i < $allNum;$i++){
            ProcessManager::getInstance()->addProcess("consumer_{$i}",ConsumerTest::class);
        }
        $setobj = new Video();
        //$setobj = new VideoModel();
        $register->add(EventRegister::onWorkerStart, function (\swoole_server $server, $workerId) use ($setobj){
            if($workerId == 0){
//                Timer::loop(2000,function () use ($setobj){
//                        $setobj->setIndexVideo();
//                });
            }
        });
    }

    public static function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}