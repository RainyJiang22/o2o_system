<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:27
 */

namespace app\admin\controller;


use think\Controller;

class Deal extends Controller
{

    public function index()
    {
        return $this->fetch();
    }
}