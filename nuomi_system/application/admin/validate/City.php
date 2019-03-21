<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/21
 * Time: 11:17
 */

namespace app\admin\validate;


use think\Validate;

class City extends Validate
{

    protected $rule = [

        ['name','require|max:5','城市名不能为空|城市名不能超过5个字符'],
        ['parent_id','number'],
        ['id','numbers'],
        ['is_default','numbers|in:0,1','是否为省会必须是数字|省会范围不合法'],
        ['status','numbers|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder','numbers'],
    ];


    /**
     * 场景设置
     */
    protected $scene = [

            'add' => ['name','parent_id','id'], //添加
            'listorder' => ['id','listorder'], //排序

    ];
}