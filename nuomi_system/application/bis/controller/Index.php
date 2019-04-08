<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Index extends Base
{

    public function index(){


       return $this->fetch();
    }

    public function welcome()
    {
        return "欢迎来到o2o-商户中心";
    }
}