<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/21
 * Time: 10:37
 */

namespace app\admin\controller;


use think\Controller;

class City extends Controller
{
    private $obj;
    public function _initialize()
    {
         $this->obj = model('City');
    }


    public function index(){
        $parentId = input('get.parent_id',0,'intval');
        $citys =$this->obj->getFirstCity($parentId);
        return $this->fetch('',[
            'citys'=>$citys,
        ]);
    }


    /**
     * @return mixed
     * 添加城市
     */
    public function add(){
        $citys = $this->obj->getNormlFirstCity();

        return $this->fetch('',[
            'citys'=>$citys,
        ]);
    }


    /**
     * 保存数据
     */
    public function save(){
       // print_r($_POST);

        $data = input('post.');
        $validate = validate('city');


        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }

        //提交到model层
        $res = $this->obj->add($data);

        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }
}