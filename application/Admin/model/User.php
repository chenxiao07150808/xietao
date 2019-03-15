<?php
namespace app\Admin\model;

use think\Model;
use think\Db;

class User extends Model
{
    /**
     * 注册操作
     * @param String $name;
     * @param String $email;
     * @param String $pwd ;
     * @param String  $salt ; 安全码
     * @return boolean
     * */
    public function add($data){
        //生成安全码
      $salt =  str_shuffle('Xietao');
      $data_add['salt'] = MD5($salt);

        //生成密码
      $data_add['password'] = MD5($data['pwd'].$data_add['salt']);
      $data_add['name']  = $data['name'];
      $data_add['email'] =  $data['email'];
      $data_add['reg_time'] = time();

         $res = Db::name('user')->insert($data_add);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function check_user($data){
       $where['email'] = $data['email'];
        $user_data = Db::name('user')->where($where)->find();
        if($user_data){
            if(MD5($data['password'].$user_data['salt'])==$user_data['password']){
                //登陆成功，种下cookie 生成token
                $time = time();
                $new_data['token'] = MD5($time.$data['email']);
                $new_data['overtime_token'] = $time+3600;
                $res = Db::name('user')->where($where)->update($new_data);
                if($res){
                    $id = $user_data['id'];
                    $token =$new_data['token'];
                    cookie('id',$id,3600);
                    cookie('token',$token,3600);
                    cookie('name', $user_data['name'],3600);
                    return true;
                }else{

                }

            }else{

            }
        }else{
            return false;
        }
    }
}