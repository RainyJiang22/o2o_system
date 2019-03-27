<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:26
 */

namespace app\api\controller;


use think\Controller;

class Category extends Controller
{
    private $obj;
    public function  _initialize()
    {
        $this->obj = model('City');
    }

    public function getCitysByParentId()
    {
       $id = input('post.id');
       if(!$id){
           $this->error('ID不合法');
       }

       //通过ID获取二级城市
        $citys = $this->obj->getNormalCitysByParentId($id);
       if (!$citys){
           return show(0,'error');
       }
       return show(1,'success',$citys);

    }


}