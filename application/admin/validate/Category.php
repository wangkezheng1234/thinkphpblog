<?php
namespace  app\admin\validate;
use think\Validate;

class Category extends  Validate{
    protected  $rule = [
        'cate_name'=>'require',
        'cate_sort'=>'require|number|between:1,99',
    ];
    protected $message =[
        'cate_name.require'=>'请填写栏目名称',
        'cate_sort.require'=>'请填写栏目排序',
        'cate_sort.number'=>'栏目排序必须为数字',
        'cate_sort.between'=>'栏目排序必须为1~99',
    ];
    
}