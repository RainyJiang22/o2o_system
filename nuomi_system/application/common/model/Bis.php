<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/19
 * Time: 16:14
 */

namespace app\common\model;


use think\Model;

class Bis extends BisModel
{

    /**
     * @param int $status
     * @return \think\paginator\Collection
     * @throws \think\exception\DbException
     * 根据状态来查找
     */
    public function getBisByStatus($status=0){
        $order = [
          'id'  => 'desc',
        ];

        $data = [
            'status' => $status,
        ];

        $result = $this->where($data)
            ->order($order)
            ->paginate();

        return $result;
    }


}