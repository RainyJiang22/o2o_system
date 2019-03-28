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


    public function getFirstCity($parentId = 0){

        $data=[
            'parent_id'=>$parentId,
            'status'=>['neq',-1],
        ];

        $order=[
            'listorder'=>'desc',
           'id'=>'desc',
        ];


        $result = $this->where($data)
            ->order($order)->paginate();


        return $result;
    }


    /**
     * 获取正常的Normal城市
     */
    public function getNormalCitysByParentId($parentId=0){
        $data=[
          'status'=>1,
          'parent_id'=>$parentId,
        ];

        $order=[
            'id'=>'desc',
        ];

        return $this->where($data)
            ->order($order)->select();
    }



}