<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Category extends Controller
{
    public function _initialize(){
        parent::_initialize();
        $this->db = new \app\common\model\Category();
    }
    public function index(){
        $data = db('cate')->select();
        $this->assign('field',$data);
        return $this->fetch();
    }
    public function store(){
        if(Request()->isPost()){
            $rs = $this->db->store(input('post.'));
            if(!$rs['valid']){
                $this->error($rs['msg']);exit;
            }else{
                $this->success($rs['msg']);
            }
        }
        return $this->fetch();
    }
}
