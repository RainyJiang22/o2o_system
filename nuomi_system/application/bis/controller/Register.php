<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Register extends Controller
{

    public function index() {
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
        ]);
    }

    /**
     * 提交商铺
     */
    public function add(){
        if (!request()->isPost()){
            $this->error('请求错误');
        }

        //获取表单的值
        $data = input('post.');
        //商户基本信息校验
       //print_r($data);
        $validate = validate('Bis');
        if (!$validate->scene('add')->check($data)){
               $this->error($validate->getError());
        }


        //获取经纬度
       $lnglat = \Map::getLngLat($data['address']);

        if(empty($lnglat) || $lnglat['status'] !=0 || $lnglat['result']['precise'] !=1) {
            $this->error('无法获取数据，或者匹配的地址不精确');
        }

        //判断提交的用户是否存在
        $accountResult = model('BisAccount')->get(['username'=>$data['username']]);
                         //echo model('BisAccount')->getLastSql();
        if ($accountResult){
            $this->error('该用户存在,请重新分配');
        }
;//
//        print_r($lnglat);
//        exit;
        // 商户基本信息入库
        $bisData = [
            'name' => $data['name'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'bank_info' =>  $data['bank_info'],
            'bank_user' =>  $data['bank_user'],
            'bank_name' =>  $data['bank_name'],
            'faren' =>  $data['faren'],
            'faren_tel' =>  $data['faren_tel'],
            'email' =>  $data['email'],
        ];

      $bisId =  model('Bis')->add($bisData);
//      echo $bisId;
//      exit;

        //总店信息校验
          $validateLocation = validate('BisLocation');
          if (!$validateLocation->scene('add')->check($data)){
              $this->error($validateLocation->getError());
          }


          $data['cat'] = '';
          if (!empty($data['se_category_id'])){
              $data['cat'] = implode('|',$data['se_category_id']);
          }

        // 总店相关信息入库
        $locationData = [
            'bis_id' => $bisId,
            'name' => $data['name'],
            'logo' => $data['logo'],
            'tel' => $data['tel'],
            'contact' => $data['contact'],
            'category_id' => $data['category_id'],
            'category_path' => $data['category_id'] . ',' . $data['cat'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'api_address' => $data['address'],
            'open_time' => $data['open_time'],
            'content' => empty($data['content']) ? '' : $data['content'],
            'is_main' => 1,// 代表的是总店信息
            'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
            'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
        ];
        $locationId = model('BisLocation')->add($locationData);
//        echo $locationId;
//        exit;

        //账户信息校验
        $validateAccount = validate('BisAccount');
        if (!$validateAccount->scene('add')->check($data)){
            $this->error($validateAccount->getError());
        }

        //账户信息入库
        //自动生成密码的加盐字符
        $data['code'] = mt_rand(100,10000);
        $accountData = [
            'bis_id'=>$bisId,
            'username'=>$data['username'],
            'code' => $data['code'],
            'password'=> md5($data['password'].$data['code']),
            'is_main'=>1,//代表的是总店管理员
        ];


        $accountId = model('BisAccount')->add($accountData);
//        print_r($accountId);
//        exit;

        if (!$accountId){
            $this->error('申请失败');
        }


        //发送邮件
        $url = request()->domain().url('bis/register/waiting', ['id'=>$bisId]);
        $title = "o2o入驻申请通知";
        $content = "您提交的入驻申请需等待平台方审核，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a> 查看审核状态";
        \phpmailer\Email::send($data['email'],$title,$content);



       // $this->success('申请成功');
        $this->success('申请成功',url('register/waiting',['id'=>$bisId]));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \think\Exception\DbException
     * 等待界面
     */
    public function  waiting($id){
        if(empty($id)){
            $this->error('error');
        }
        $detail = model('Bis')->get($id);

        return $this->fetch('',[
            'detail' => $detail,
        ]);
   //     return 'test';
}

}