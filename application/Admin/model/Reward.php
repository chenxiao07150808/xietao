<?php
namespace app\Admin\model;

use think\Model;
use think\Db;

class Reward extends Model
{
    /**
     * 添加学科操作
     * @param String $name;
     * @return boolean
     * */
    public function add($data){
        $add_data['create_time'] = time();
        $add_data['reward_type'] = $data['reward_type'];
        $add_data['term'] = $data['term'];
        $add_data['student_id'] = $data['student_id'];
        $res = Db::name('reward')->insert($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}