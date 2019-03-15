<?php
/**
 * Created by PhpStorm.
 * User: xietao
 * Date: 2018/4/15
 * Time: 23:05
 */
//科目
namespace app\Admin\controller;
use think\Controller;
use think\Db ;
use think\Model;
use think\Request;
class Course extends Controller
{
  /**
   * 学科列表
   * Date:2018
   * Author:XieTao
   */
    public function course_list()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        $data = Db::name('score_type')->select();
        $data_count = Db::name('score_type')->count();

        $this->assign("data",$data);
        $this->assign("data_count",$data_count);
        return $this->fetch();
    }
    /**
     * 学科表单
     * Date:2018
     * Author:XieTao
     */
    public function course_add()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        return $this->fetch();
    }
    public function course_confire()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        if(Request::instance()->post()){
            $data = input('post.');
            $res =  model('Course')->add($data);
            if($res){
                echo json_encode(['msg'=>'注册成功！','code'=>'1000']);
            }else{
                echo json_encode(['msg'=>'注册失败！','code'=>'1001']);
            }
        }else{
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
}