<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/4/2
 * Time: 17:59
 */

namespace app\common\validate;


use think\Validate;

class BisAccount extends Validate
{

    protected $rule = [

        'username'  => 'require|max:15',
        'password'  => 'require',
    ];


    //场景设置
    protected $scene = [
        'add' => ['username','password'],
      ];
}