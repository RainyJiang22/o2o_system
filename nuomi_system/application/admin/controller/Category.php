<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:26
 */

namespace app\admin\controller;


use think\Controller;

class Category extends Controller
{
    private $obj;
    public function  _initialize()
    {
        $this->obj = model('Category');

    }

    public function index()
    {
        $parentId = input('get.parent_id',0,'intval');
        $categorys = $this->obj->getFirstCategorys($parentId);
        return $this->fetch('',[
            'categorys' => $categorys,
        ]);
    }

    public function add()
    {
        $categorys = $this->obj->getNormlFirstCategory();
        return $this->fetch('',[
            'categorys'=>$categorys,

        ]);
    }

    /**
     * 编辑功能
     */
     public function edit($id=0){

         if(intval($id) <1){
             $this->error('参数不合法');
         }

         $category=$this->obj->get($id);
       //  print_r($category);

         $categorys = $this->obj->getNormlFirstCategory();
         return $this->fetch('',[
             'categorys'=>$categorys,
             'category'=>$category

         ]);


     }

    /*
     * 保存数据
     */
    public function save()
    {
       // print_r($_POST);
     //   print_r(input('post.'));
       // print_r(request()->post());


        /**
         * 做校验
         */
        if (!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
        //$data['status'] = 10;
        $validate = validate('Category');

        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        if (!empty($data['id'])){
            return $this->update($data);
        }


         //把$data提交到model层
        $res = $this->obj->add($data);

      if ($res){
          $this->success('新增成功');
      }else{
          $this->error('新增失败');
      }
    }


    /**
     * 更新操作
     */

    public function update($data){
        $res = $this->obj->save($data,['id'=> intval($data['id'])]);

        if ($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    /**
     * 排序操作
     */
    public function listorder($id,$listorder){

//        echo $id."<br/>";
//        echo $listorder."<br/>";

        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'更新成功');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }
    }

    /**
     * 修改状态
     */

    public function status(){
//        print_r(input('get.'));
        $data = input('get.');
        //$data['status'] = 10;
        $validate = validate('Category');

        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=> $data['status']],
            ['id'=>$data['id']]);
           if ($res){
               $this->success('状态更新成功');
           }else{
               $this->error('状态更新失败');
           }

    }
}