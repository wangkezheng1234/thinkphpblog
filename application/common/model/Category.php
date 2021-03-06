<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $pk = 'cate_id';
    protected $table = 'blog_cate';
    public function store($data){
        $rs = $this->validate(true)->save($data);
        if(false === $rs){
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            return ['valid'=>1,'msg'=>'添加成功'];
        }
    }
    public function edit($data){
        $rs = $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
        if(false === $rs){
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            return ['valid'=>1,'msg'=>'编辑成功'];
        }
    }
}
