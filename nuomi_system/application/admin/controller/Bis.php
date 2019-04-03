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


    /**
     * @return mixed
     * 入驻详情页面
     */
    public function detail()
    {
        $id = input('get.id');
        if (empty($id)){
            return $this->error('ID错误');
        }


        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();

        //获取商户数据
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id,
          'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,
          'is_main'=>1]);

        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
            'bisData' => $bisData,
            'locationData' => $locationData,
            'accountData' => $accountData,
        ]);
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