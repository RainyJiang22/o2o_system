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
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Bis');
    }

    public function index()
    {
        return $this->fetch();
    }

    public function dellist()
    {
        return $this->fetch();
    }

    /**
     * @return mixed
     * 入驻申请列表
     */
    public function apply()
    {
        $bis = $this->obj->getBisByStatus();

        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }
}