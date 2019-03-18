<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:29
 */

namespace app\admin\controller;


use think\Controller;

class Featured extends Controller
{

    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }
}