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

    public function index() {
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
        ]);
    }

    /**
     * 提交商铺
     */
    public function add(){
        if (!request()->isPost()){
            $this->error('请求错误');
        }

        //获取表单的值
        $data = input('post.');
        //检验数据
       //print_r($data);
        $validate = validate('Bis');
        if (!$validate->scene('add')->check($data)){
          //  $this->error($validate->getError());
        }

        //获取经纬度
       $lnglat =  \Map::getLngLat($data['address']);
        if(empty($lnglat) || $lnglat['status'] !=0 ||
        $lnglat['result']['precise'] !=1){
            $this->error('无法获取数据，或者匹配不精准');
        }

        // 商户基本信息入库
        $bisData = [
            'name' => $data['name'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'bank_info' =>  $data['bank_info'],
            'bank_user' =>  $data['bank_user'],
            'bank_name' =>  $data['bank_name'],
            'faren' =>  $data['faren'],
            'faren_tel' =>  $data['faren_tel'],
            'email' =>  $data['email'],
        ];

      $bisId =  model('Bis')->add('$bisdata');
      echo $bisId;
      exit;
    }

}