<?php


namespace App\Model;
use App\Model\Base;

class Video extends Base
{
    public $tableName = "video";
    public function add($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        return $this->db->insert($this->tableName,$data);
    }
    public function getVideo($condition=[],$page=1,$size=10){
        if(!empty($size)){
            $this->db->pageLimit = $size;
        }
        $res = $this->db->paginate($this->tableName,$page);
        $data = [
            'lists' => $res,
            'page_size' => $size,
            'total_page' => $this->db->totalPages,
            'count' => $this->db->totalCount,
        ];
        return $data;
    }
    public function getCacheVideo($condition=[],$size=10){
        if(!empty($size)){
            $this->db->pageLimit = $size;
        }
        if(!empty($condition['cat_id'])){
            $this->db->where('cat_id',$condition['cat_id']);
        }
        $this->db->orderBy('id','desc');
        $res = $this->db->paginate($this->tableName,1);
        return $res;
        //echo time();
      }
}