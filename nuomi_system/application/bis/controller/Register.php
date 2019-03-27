<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Register extends Controller
{

    public function index(){

        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();

        return $this->fetch('',[
            'citys'=>$citys,
        ]);
    }
}