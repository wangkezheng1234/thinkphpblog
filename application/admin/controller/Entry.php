<?php

namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin;

class Entry extends Common
{
    public function index(){
        return $this->fetch();
    }
    public function pass(){
        if(request()->isPost()){
            $rs = (new Admin())->pass(input('post.'));
            if($rs['valid']){
                session(null);
                $this->success($rs['msg'],'admin/entry/index');
            }else{
                $this->error($rs['msg']);exit;
            }
        }
        return $this->fetch();
    }
}