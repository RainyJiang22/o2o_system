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

    /*
     * 保存数据
     */
    public function save()
    {
       // print_r($_POST);
     //   print_r(input('post.'));
       // print_r(request()->post());
        $data = input('post.');
        $data['status'] = 10;
        $validate = validate('Category');

        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }

         //把$data提交到model层
        $res = $this->obj->add($data);

      if ($res){
          $this->success('新增成功');
      }else{
          $this->error('新增失败');
      }
    }
}