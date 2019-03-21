<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/21
 * Time: 19:38
 */

namespace app\common\model;


use think\Model;

class City extends Model
{

    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        // $data['create_time'] = time();

        return $this->save($data);
    }

    public function getNormlFirstCity(){
        $data = [
            'status' => 1,
            'parent_id' => 0,
        ];

        $order = [
            'id' => 'desc',

        ];

        return $this->where($data)
            ->order($order)->select();
    }



}