<?php


namespace App\Model;
use EasySwoole\Core\Component\Di;

class Base
{
    public $db = "";
    public function __construct()
    {
        if(empty($this->tableName)){
           throw new \Exception('TABLENAME ERROR');
        }
        $db = Di::getInstance()->get("MYSQL");
        if($db instanceof \MysqliDb){
            $this->db = $db;
        }else{
            throw new\Exception('DB ERROR');
        }
    }
}