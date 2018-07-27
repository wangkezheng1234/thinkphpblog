<?php

namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin;

class Login extends Controller
{
    public function login(){
        if(request()->isPost()){
            $rs = (new Admin())->login(input('post.'));
            if($rs['valid']){
                $this->success($rs['msg'],'admin/entry/index');
            }else{
                $this->error($rs['msg']);exit;
            }
        }
        //加载我们登录页面
        return $this->fetch('index');
    }
}