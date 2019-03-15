<?php
/**
 * Created by PhpStorm.
 * User: xietao
 * Date: 2018/4/15
 * Time: 23:05
 */
//科目
namespace app\Admin\controller;
use think\console\Command;
use think\Controller;
use think\Db ;
use think\Model;
use think\Request;
class Reward extends Controller
{
  /**
   * 学科列表
   * Date:2018
   * Author:XieTao
   */
    public function reward_list()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        $data=Db::name('student')
            ->alias('a')
            ->join('st_reward w','a.degree = w.student_id')
            ->select();
        //这里可以用链表代替
       foreach($data as $key => $value){
           $where['id'] =$value['term'] ;
          $result=Db::name('term')->where($where)->find();
           $data[$key]['term'] = $result['name'];
           $where2['id'] = $value['reward_type'];
           $result2=Db::name('reward_type')->where($where)->find();
           $data[$key]['reward_type'] = $result2['name'];
       }

        $data_count = Db::name('reward')
        ->alias('a')
        ->join('st_student w','a.student_id = w.degree')
        ->count();

        $this->assign("data",$data);
        $this->assign("data_count",$data_count);
        return $this->fetch();
    }
    /**
     * 学科表单
     * Date:2018
     * Author:XieTao
     */
    public function reward_add()
    {  $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        $term_data = Db::name('term')->select();
        $this->assign("term_data",$term_data);

        $reward_type = Db::name('reward_type')->select();
        $this->assign("reward_type",$reward_type);


        $student_data = Db::name('student')->select();
        $this->assign("student_data",$student_data);

        return $this->fetch();
    }
    public function reward_confire()
    {
        $id = cookie('id');
        $token = cookie('token');

        if(!confrimAdminToken($id,$token)){
            $this->error("请登陆！！","Index/login");
        }
        if(Request::instance()->post()){
            $data = input('post.');
            $res =  model('Reward')->add($data);
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