<?php
use think\Db;
/**
 * 管理员token验证
 * @param string $ad_id 管理员id
 * @param string $token 管理员token
 * @return boolean
 */
function confrimAdminToken($id, $token){

 $adminModel = Db::name('user');

 $where['id'] = $id;
 $token_info = $adminModel->where($where)->field('token, overtime_token')->find();

 if($token_info['token'] != $token){

  cookie('id', null);
  cookie('token', null);
  cookie('name', null);

  return false;
 }elseif($token_info['overtime_token']<time()){

  cookie('id', null);
  cookie('token', null);
  cookie('name', null);

  return false;
 }else{

  return true;
 }
}
