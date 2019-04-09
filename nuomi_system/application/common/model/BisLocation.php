<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/19
 * Time: 16:14
 */

namespace app\common\model;


use think\Model;

class BisLocation extends BisModel
{

    public function getNormalLocationByBisIds(){

      //  session('bisAccount','','bis');
        $bis_id = $this->getLoginUser()->bis_id;

       $data = [
           'status' => ['neq',-1],
           'bis_id' => $bis_id,
       ];

       $order = [
           'id' => 'desc',
       ];
       $result =  $this->where($data)
           ->order($order)->paginate();

       return $result;
    }



}