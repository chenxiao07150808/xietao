<?php
namespace app\Admin\model;

use think\Model;
use think\Db;

class Course extends Model
{
    /**
     * 添加学科操作
     * @param String $name;
     * @return boolean
     * */
    public function add($data){
        $add_data['name'] = $data['username'];
        $add_data['create_time'] = time();
        $res = Db::name('score_type')->insert($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}