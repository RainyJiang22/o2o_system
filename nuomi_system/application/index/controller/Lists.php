<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/17
 * Time: 20:59
 */

namespace app\index\controller;


use think\Controller;

class Lists extends Controller
{


    public function lists()
    {
        return $this->fetch();
    }
}