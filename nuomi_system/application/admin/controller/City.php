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

    public function index(){
        return $this->fetch();
    }


    /**
     * @return mixed
     * 添加城市
     */
    public function add(){
        return $this->fetch();
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
    }
}