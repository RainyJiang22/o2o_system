<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Login extends Controller
{

    public function index(){

        if (request()->isPost()){
            //登录
            //获取相关数据
            $data  = input('post.');
            //通过用户名来获取相关信息
            //进行下相关的校验
             $validate = validate('BisAccount');
             if (!$validate->scene('add')->check($data)){
                 $this->error($validate->getError());
             }

          $ret =  model('BisAccount')->get(['username'=>$data['username']]);
             if (!$ret || $ret->status != 1){
                 $this->error('该用户不存在，获取用户未被审核通过');
             }

             if ($ret->password != md5($data['password'].$ret->code)){
                 $this->error('密码不正确');
             }


             model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);

             //保存用户信息 bis是作用域
            session('bisAccount',$ret,'bis');
            return $this->success('登录成功',url('index/index'));


        }else{
            //获取session
            $account = session('bisAccount','','bis');
            if ($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    public function logout(){
        //清除session
        session(null,'bis');
         //跳出
        $this->redirect('login/index');
    }
}