<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/19
 * Time: 16:14
 */

namespace app\common\model;

use think\Model;

class BisAccount extends  BisModel
{

  public function updateById($data,$id){

      //allowField 过滤数据中非数据库中的数据
      return $this->allowField(true)->save($data,['id'=>$id]);
  }
}