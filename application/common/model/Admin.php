<?php

namespace app\common\model;

use think\Model;
use think\Loader;
use think\Validate;

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
    public function pass($data){
       #数据格式是否正确
        $validate = new Validate(
            [
                'password'=>'require',
                'new_password'=>'require',
                'confirm_password'=>'require|confirm:new_password',
            ],
            [
                'password.require'=>'原始密码不能为空',
                'new_password.require'=>'新密码不能为空',
                'confirm_password.require'=>'确认密码不能为空',
                'confirm_password.confirm'=>'原始密码和新密码不一致',
            ]
            );
        #检测原始密码是否正确
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        $rs = $this->where('admin_id',session('admin.admin_id'))->where('admin_password',$data['password'])->find();
        if(!$rs){
            return ['valid'=>0,'msg'=>'原始密码数据'];
        }
        #修改密码
        $rs = $this->save(['admin_password'=>$data['new_password']],[$this->pk=>session('admin.admin_id')]);
        if(!$rs){
            return ['valid'=>0,'msg'=>'密码修改失败'];
        }else{
            return ['valid'=>1,'msg'=>'密码修改成功'];
        }
    }
}
