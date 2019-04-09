<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/18
 * Time: 18:22
 */

namespace app\admin\controller;


use think\Controller;

class Bis extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Bis');
    }

    /**
     * @return mixed
     * 商户列表
     */
    public function index()
    {
        $bis = $this->obj->getBisByStatus(1);


        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }

    /**
     * @return mixed
     * 删除商户列表
     */
    public function dellist()
    {
        $bis = $this->obj->getBisByStatus(-1);


        return $this->fetch('',[
            'bis' => $bis,
        ]);
    }



    /**
     * @return mixed
     * 入驻详情页面
     */
    public function detail()
    {
        $id = input('get.id');
        if (empty($id)){
            return $this->error('ID错误');
        }


        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();

        //获取商户数据
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id,
          'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,
          'is_main'=>1]);

        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
            'bisData' => $bisData,
            'locationData' => $locationData,
            'accountData' => $accountData,
        ]);
    }

    /**
     * @return mixed
     * 入驻申请列表
     */
    public function apply()
    {
        $bis = $this->obj->getBisByStatus();
        $bislocation = model('BisLocation')->getNormalLocationByStatus();

        return $this->fetch('',[
            'bislocation' => $bislocation,
            'bis' => $bis,
        ]);
    }


    /**
     * 修改状态
     */
// 修改状态
    public function  status() {
        $data = input('get.');


        $validate = validate('Bis');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        $location = model('BisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        $status = $data['status'];
        $bisData = model('Bis')->get($data);
                if($res && $location && $account) {
//            // 发送邮件

            // status 1  status 2  status -1
               if($status == 1){

                   $title = "o2o入驻申请";
                   $content = "你的入驻申请审核已通过，请查看详情";
                   \phpmailer\Email::send($bisData['email'],$title, $content);
               }else if($status == 2){
                   $title = "o2o入驻申请";
                   $content = "你的入驻申请审核未通过，请重新修改资料再提交";
                   \phpmailer\Email::send($bisData['email'],$title, $content);
               }else if($status == -1){
                   $title = "o2o入驻申请";
                   $content = "你的入驻申请信息已被删除，请重新提交";
                   \phpmailer\Email::send($bisData['email'],$title, $content);
               }

           $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }
}