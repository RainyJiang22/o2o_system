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


    /**
     * @return \think\paginator\Collection
     * @throws \think\exception\DbException
     * 商家后台，根据session获取商家信息进行查询该商户下的商家信息
     */
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


    /**
     * 主后台申请 直接根据状态查询
     */
    public function getNormalLocationByStatus($status=0){

        $data =[
           'status' => $status,
        ];

        $order = [
           'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order)->paginate();
        return $result;
    }



}