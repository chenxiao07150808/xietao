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
class Common extends Controller
{

   public function __construct(Request $request)
   {
     /*  $id = cookie('id');
       $token = cookie('token');

       if(!confrimAdminToken($id,$token)){
         $this->redirect("Index/login","请重新登陆！");
       }*/
   }
}