<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/17
 * Time: 20:53
 */

namespace app\index\controller;


use think\Controller;

class Pay extends Controller
{


    public function pay()
    {
        return $this->fetch();
    }


    public function payorder()
    {
        return $this->fetch();
    }
}