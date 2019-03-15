<?php
namespace app\Admin\controller;
use think\Controller;
use think\Db ;
use think\Model;
use think\Request;
class Index extends Controller
{
    /**
     * 首页
     */
    public function index(){
        $id = cookie('id');
        $token = cookie('token');
        $name = cookie('name');

      if(!confrimAdminToken($id,$token)){

          $this->success("请登陆！！","Index/login");
      }
        $this->assign('name',$name);
        return $this->fetch();
    }
    public function welcome(){
        return $this->fetch();
    }
    /**
     *注册表单
     * Author : Xie
     * Date:2018
     */
    public function register()
    {
        return $this->fetch();
    }
    /**
     * 注册操作过程
     * Author : Xie
     * Date:2018
     * */
    public function reg_confire(){
        //获取Post上传的参数
        if(Request::instance()->post()){
            $data = input('post.');
            $res =  model('User')->add($data);
            if($res){
               // echo json_encode(['msg'=>'注册成功！','code'=>'1000']);
                return true;
            }else{
                echo json_encode(['msg'=>'注册失败！','code'=>'1001']);
            }
        }else{
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
    /**
     * 登陆表单
     * Author : Xie
     * Date:2018
     * */
    public function login(){
        return $this->fetch();
    }
    /**
     * 登陆操作
     * Author : Xie
     * Date:2018
     * */
    public function login_confire(){
        if(Request::instance()->post()){
            $data = input('post.');
            $res =  model('User')->check_user($data);
            if($res){
               // echo json_encode(['msg'=>'登陆成功！','code'=>'1000']);
                return true;
            }else{
                echo json_encode(['msg'=>'登陆失败！','code'=>'1001']);
            }
        }
    }
    public function exit_login(){
        cookie(null, 'id');
        cookie(null, 'token');
        $this->success("退出登录！","Index/login");
    }
}
