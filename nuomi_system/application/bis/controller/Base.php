<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2019/3/25
 * Time: 19:32
 */
namespace app\bis\controller;
use think\Controller;

class Base extends Controller
{

    private $account;
   public function _initialize(){
     //判断用户是否登录
       $isLogin = $this->isLogin();
       if (!$isLogin){
           return $this->redirect('login/index');
       }
   }


   //判断是否登录
    public function isLogin(){

       //获取Session
        $user = $this->getLoginUser();

      if ($user && $user->id){
          return true;
      }
      return false;
    }

    public function getLoginUser(){
        if(!$this->account) {
            $this->account = session('bisAccount', '', 'bis');
        }
      return $this->account;
    }

}