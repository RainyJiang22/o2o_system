<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/17
 * Time: 21:03
 */

namespace app\index\controller;


use think\Controller;

class Detail extends Controller
{

    public function detail()
    {
        return $this->fetch();
    }
}