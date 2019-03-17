<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/17
 * Time: 23:14
 */
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{

    public function index()
    {
        return $this->fetch();
    }
}