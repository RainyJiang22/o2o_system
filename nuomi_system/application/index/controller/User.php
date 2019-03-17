<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/17
 * Time: 20:42
 */

namespace app\index\controller;


use think\Controller;

class User extends Controller
{

    /**
     * @return mixed
     * 登录页面
     */

    public function login(){
        return $this->fetch();
    }

    /**
     * @return mixed
     * 注册页面
     */

    public function register(){
        return $this->fetch();
    }
}