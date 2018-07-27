<?php

namespace app\common\model;

use think\Model;
use think\Loader;

class Admin extends Model
{
    //
    protected $pk = 'admin_id';
    protected $table = 'blog_admin';
    public function login($data){
        //数据格式验证
        $validate = Loader::validate('Admin');
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //用户数据验证
        $rs = $this->where('admin_username',$data['admin_username'])->where('admin_password',$data['admin_password'])->find(1);
        if(!$rs){
            return ['valid'=>0,'msg'=>'用户名或密码不正确'];
        }
        //装session
        //echo $rs['admin_id'].'||'.$rs['admin_username'];die;
        session('admin.admin_id',$rs['admin_id']);
        session('admin.admin_username',$rs['admin_username']);
        return ['valid'=>1,'msg'=>'登录成功'];
        
    }
}
