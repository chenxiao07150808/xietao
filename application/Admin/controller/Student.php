<?php
namespace app\Admin\controller;
use think\Controller;
use think\Db ;
use think\Model;
use think\Request;

class Student  extends Controller
{
    /**
     * 学生列表
     * Date：2018/04/15
     * Author:Tietao
     */
    public function student_list(){
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->redirect("Index/login","请重新登陆！");
        }
        $data = Db::name('student')->select();
        $data_count = Db::name('student')->count();

        $this->assign("data",$data);
        $this->assign("data_count",$data_count);
      return $this->fetch();
    }
   /**
    *添加学生表单
    * Date：2018/04/15
    * Author:Tietao
    */
    public function student_add(){
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->redirect("Index/login","请重新登陆！");
        }
        $term_data = Db::name('term')->select();
        $this->assign("term_data",$term_data);
        return $this->fetch();
    }
    /**
     *添加学生
     * Date：2018/04/15
     * Author:Tietao
     */
    public function student_confire()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        if (Request::instance()->post()) {
            $data = input('post.');
            $res =  model('Student')->student_add($data);
            if($res){
                echo json_encode(['msg'=>'添加成功！','code'=>'1001']);
            }

        } else {
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
    /**
     *更新学生表单
     * Date：2018/04/15
     * Author:Tietao
     */
    public function student_updata(){
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
       $where['id'] =Request::instance()->param('id');
        $data = Db::name('student')->where($where)->find();
        $this->assign("data",$data);
        return $this->fetch();
    }
    /**
     *更新学生操作
     * Date：2018/04/15
     * Author:Tietao
     */
    public function student_confire2(){

        if (Request::instance()->post()) {
            $data = input('post.');
            $res =  model('Student')->student_save($data);
            if($res){
                echo json_encode(['msg'=>'添加成功！','code'=>'1000']);
            }

        } else {
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
    /**
     *删除学生操作
     * Date：2018/04/15
     * Author:Tietao
     */
        public  function del_student()
    {
        if (Request::instance()->post()) {
            $data= input('post.');
            //$where['id'] = $data['id'];
            $res =  model('Student')->where($data)->delete();
            if($res){
               return true;
            }

        } else {
          return false;
        }
    }
}