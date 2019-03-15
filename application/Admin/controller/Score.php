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
class Score extends Controller
{
  /**
   * 成绩列表
   * Date:2018
   * Author:XieTao
   */
    public function score_list()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->redirect("Index/login","请重新登陆！");
        }
        $data=Db::name('student')
            ->alias('a')
            ->join('st_score w','a.degree= w.student_id')
            ->select();
        //这里可以用链表代替
       foreach($data as $key => $value){
           $where['id'] =$value['term'] ;
           $result=Db::name('term')->where($where)->find();
           $data[$key]['term'] = $result['name'];
           $where2['id'] = $value['score_type'];
           $result2=Db::name('score_type')->where($where2)->find();
           $data[$key]['score_type'] = $result2['name'];
       }

        $data_count = Db::name('score')
        ->alias('a')
        ->join('st_student w','a.student_id = w.degree')
        ->count();

        $this->assign("data",$data);
        $this->assign("data_count",$data_count);
        return $this->fetch();
    }
    /**
     * 成绩表单
     * Date:2018
     * Author:XieTao
     */
    public function score_add()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        $term_data = Db::name('term')->select();
        $this->assign("term_data",$term_data);

        $course_data = Db::name('score_type')->select();
        $this->assign("course_data",$course_data);


        $student_data = Db::name('student')->select();
        $this->assign("student_data",$student_data);

        return $this->fetch();
    }

    /**
     *
     */
    public function score_confire()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        if(Request::instance()->post()){
            $data = input('post.');
            $res =  model('Score')->add($data);
            if($res){
                echo json_encode(['msg'=>'注册成功！','code'=>'1000']);
            }else{
                echo json_encode(['msg'=>'注册失败！','code'=>'1001']);
            }
        }else{
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
    /**
     * 成绩更新
     * Date:2018
     * Author:XieTao
     */
    public function score_updata(){
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        $where['id'] =Request::instance()->param('id');
        $data = Db::name('score')->where($where)->find();
        $where2['id'] =$data['term'] ;
        $result=Db::name('term')->where($where2)->find();
        $data['term_name'] = $result['name'];
        $where3['id'] = $data['score_type'];
        $result2=Db::name('score_type')->where($where3)->find();
        $where4['degree'] = $data['student_id'];
        $result3=Db::name('student')->where($where4)->find();
        $data['student_name'] = $result3['name'];
        $data['score_type_name'] = $result2['name'];
        $this->assign("data",$data);

        $term_data = Db::name('term')->select();
        $this->assign("term_data",$term_data);

        $course_data = Db::name('score_type')->select();
        $this->assign("course_data",$course_data);


        $student_data = Db::name('student')->select();
        $this->assign("student_data",$student_data);

        return $this->fetch();
    }
    /**
     *更新成绩操作
     * Date：2018/04/15
     * Author:Tietao
     */
    public function score_confire2(){

        if (Request::instance()->post()) {
            $data = input('post.');
            $res =  model('score')->score_save($data);
            if($res){
                echo json_encode(['msg'=>'添加成功！','code'=>'1000']);
            }

        } else {
            echo json_encode(['msg'=>'不合法请求！','code'=>'1001']);
        }
    }
    /**
     *删除操作
     * Date：2018/04/15
     * Author:Tietao
     */
    public  function del_score()
    {
        if (Request::instance()->post()) {
            $data= input('post.');
            //$where['id'] = $data['id'];
            $res =  model('score')->where($data)->delete();
            if($res){
                return true;
            }

        } else {
            return false;
        }
    }
}