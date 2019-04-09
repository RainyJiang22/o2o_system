<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/4/9
 * Time: 16:57
 */

namespace app\bis\controller;


use think\Controller;

class Deal extends Base
{


    public function index(){
      return $this->fetch();

    }

    /**
     * 团购商品添加
     */
    public function add(){


        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
        ]);
    }
}