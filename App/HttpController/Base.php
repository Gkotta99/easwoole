<?php

namespace App\HttpController;

use EasySwoole\Core\Http\AbstractInterface\Controller;

class Base extends Controller
{
    public function index()
    {
    }
    public function pageInto($count,$data){ //对数据进行分页
        $to_page = ceil($count / $this->request()->getQueryParam('size')); //获取总页码
        return [
            'all_page' => $to_page,  //总页码
            'page_size' => intval($this->request()->getQueryParam('page')),//当前页码
            'count' => $count,//数据总数
            'list' => $data,
        ];
    }
}