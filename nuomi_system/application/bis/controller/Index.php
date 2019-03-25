<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Index extends Controller
{

    public function index(){
        return $this->fetch();
    }
}