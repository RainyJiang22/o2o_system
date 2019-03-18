<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:22
 */

namespace app\admin\controller;


use think\Controller;

class Bis extends Controller
{

    public function index()
    {
        return $this->fetch();
    }

    public function dellist()
    {
        return $this->fetch();
    }

    public function apply()
    {
        return $this->fetch();
    }
}