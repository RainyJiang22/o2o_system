<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/4/2
 * Time: 9:48
 */

namespace app\common\validate;


use think\Validate;

class BisLocation extends Validate
{

    protected $rule = [
       'name' => 'require|max:30',
        'logo' => 'require',
        'address' => 'require',
        'tel'   => 'require',
        'contact' => 'require',
        'open_time' => 'require',
        'content' => 'require',
        'city_id' => 'require',
        'category_id' => 'require'
    ];


    //场景设置
    protected $scene = [
        'add' => ['name','logo','address','tel','contact','open_time','content','city_id','category_id'],
    ];

}