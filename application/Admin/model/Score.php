<?php
namespace app\Admin\model;

use think\Model;
use think\Db;

class Score extends Model
{
    /**
     * 添加学科操作
     * @param String $name;
     * @return boolean
     * */
    public function add($data){
        $add_data['score'] = $data['score'];
        $add_data['create_time'] = time();
        $add_data['score_type'] = $data['score_type'];
        $add_data['term'] = $data['term'];
        $add_data['student_id'] = $data['student_id'];
        $res = Db::name('score')->insert($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function score_save($data)
    {
        $where['id'] = $data['id'];

        $add_data['score'] = $data['score'];
        //$add_data['create_time'] = time();
        $add_data['score_type'] = $data['score_type'];
        $add_data['term'] = $data['term'];
        $add_data['student_id'] = $data['student_id'];

        $res = Db::name('score')->where($where)->update($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}