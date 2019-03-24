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


        /**
         * 做校验
         */
        if (!request()->isPost()){
            $this->error('请求失败');
        }

        $data = input('post.');
        $validate = validate('City');


        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        if (!empty($data['id'])){
            return $this->update($data);
        }

        //提交到model层
        $res = $this->obj->add($data);

        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

    /**
     * 编辑功能
     */
    public function edit($id =0){

        if (intval($id) <1){
            $this->error('参数不合法');
        }

        $city=$this->obj->get($id);

        $citys = $this->obj->getNormlFirstCity();

        return $this->fetch('',[
            'citys'=>$citys,
            'city'=>$city,
        ]);
    }

    /**
     * 更新操作
     */
    public function update($data){

        $res = $this->obj->save($data,['id'=>intval($data['id'])]);

        if ($res) {
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }


    /**
     * 修改状态
     */
    public function status(){
        $data = input('get.');
        $validate = validate('City');
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']],
            ['id'=>$data['id']]);
        if ($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }

    /**
     * 排序
     */
    public function listorder($id,$listorder){


        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'更新成功');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }
    }



}