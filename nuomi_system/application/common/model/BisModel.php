<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/19
 * Time: 16:14
 */

/**
 * 公共的model层
 */

namespace app\common\model;


use think\Model;

class BisModel extends Model
{

    private $account;
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 0;
       // $data['create_time'] = time();
        $this->save($data);
        return $this->id;
    }


    public function getLoginUser(){
        if(!$this->account) {
            $this->account = session('bisAccount', '', 'bis');
        }
        return $this->account;
    }

}