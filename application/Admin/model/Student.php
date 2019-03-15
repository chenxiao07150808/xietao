<?php
namespace app\Admin\model;
use think\Model;
use think\Db;
class Student extends Model
{
    public function student_add($data)
    {
      $add_data['name'] = $data['username'];

       $add_data['sex'] = $data['sex'];
        $add_data['phone'] = $data['mobile'];
        $add_data['email'] = $data['email'];
        $add_data['address'] = $data['address'];
        $add_data['degree'] = $data['degree'];
        $add_data['create_time'] = time();
        $res = Db::name('student')->insert($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function student_save($data)
    {
        $where['id'] = $data['id'];

        $add_data['name'] = $data['username'];
        $add_data['sex'] = $data['sex'];
        $add_data['phone'] = $data['mobile'];
        $add_data['email'] = $data['email'];
        $add_data['address'] = $data['address'];
        $add_data['degree'] = $data['degree'];

        $res = Db::name('student')->where($where)->update($add_data);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}