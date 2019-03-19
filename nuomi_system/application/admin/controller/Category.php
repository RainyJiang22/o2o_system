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

    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }

    /*
     * 保存数据
     */
    public function save()
    {
       // print_r($_POST);
     //   print_r(input('post.'));
       // print_r(request()->post());
    }
}