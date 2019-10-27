<?php

namespace App\HttpController;

use App\HttpController\Base;
use \EasySwoole\Core\Component\Di;
use Elasticsearch\ClientBuilder;

class Index extends Base
{
    public function onRequest($action):?bool  //全局对象 必须重写 可以做拦截器，请求到达前验证
    {
        if($this->request()->getRequestParam('id')==1){
            $this->writeJson('400','内部错误');
            return false;
        }else{
            return true;
        }
    }
    public function test(){
       return $this->index();
    }
    public function getDate(){
        new abc();
        $getlist = Di::getInstance()->get('MYSQL');  //从ioc容器获取单例mysql配置
        $data = $getlist->where('id',2)->getOne('tp_test');  //查询语句
        $this->writeJson(200,'获取成功',$data);
    }
    public function onException(\Throwable $throwable, $actionName): void   //全局异常 必须重写
    {
        $this->writeJson('500','服务器出错');
    }
    public function esindex(){
        $parms = [             //查询绑定参数
            "index" => "vide_mi",  //索引名
            "type" => "_doc",      //索引类型 7.0后取消type改为_doc
            //"id" => 1               //索引ID
            "body" => [
                "query" => [
                    "match" => [
                        "name" => "战狼"
                    ],
                ],
            ],
        ];
        $res = Di::getInstance()->get("ES")->search($parms); //创建某个集群节点的客户端 //查询
        return $this->writeJson('200','success',$res);
    }
    public function estest(){
        $parms = [
            "index" => "vide_mi", //索引名 相当于mysql表
            "type" => "_doc",
            "body" => [
                "query" => [
                    "match" => [
                        "name" => "战狼"
                    ],
                ],
                "from" => (intval($this->request()->getQueryParam('page'))-1) * intval($this->request()->getQueryParam('size')),//当前页码-1乘以size就是翻页的数据数
                "size" => $this->request()->getQueryParam('size'),
            ],
        ];
        $res = Di::getInstance()->get("ES")->search($parms);//获取索引数据
        $count = $res['hits']['total']['value'];//获取数据总数
        foreach ($res['hits']['hits'] as $hit){  //遍历数据 只需要hits下面的数据
            $resdata[] = [
                'id' => intval($hit['_id']),
                'name' => $hit['_source']['name'],
                'age' => $hit['_source']['age'],
                'email' => $hit['_source']['email'],
            ];
        }
       return $this->writeJson('200','success',$this->pageInto($count,$resdata));
    }
}
