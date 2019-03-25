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

    public function test()
    {
        \Map::getLngLat('广东深圳龙岗区布吉');
    }

    public function map(){
        return \Map::staticimage('广东深圳龙岗区布吉');
    }

    public function welcome()
    {
       // \phpmailer\Email::send('3434481891@qq.com','未来科技','恭喜你收到答复');
       // return '发送邮件成功';
        return "欢迎来到o2o后台";
    }
}