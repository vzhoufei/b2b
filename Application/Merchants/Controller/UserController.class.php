<?php
/*
*   创建 2016-11-15 
*   用户模块User
*/
namespace Merchants\Controller;
use Think\Controller;
Class UserController extends Controller
{


/**
  * 用户登录
  *@author 周飞
  */
  public function login()
  {
      if(IS_POST){
          // if(session('merchantsuser')){$this->redirect('Index/index');}

        $name = I('account');//用户名
        $pwd = md5(I('password'));//用户密码
        $check = I('check')?604800:3600;
        if($name && $pwd){
          $user_m = M('Users');
          $str = $user_m->where("name = '%s' or email = '%s' or mobile = '%s'",array($name,$name,$name))->getField('password_rand');//查询用户随机窜
          if($str){
            $pass = md5($pwd.$str);//用户正式密码
            $user = $user_m->where("(name = '%s' or email = '%s' or mobile = '%s') and password = '%s'",array($name,$name,$name,$pass))->find();
            if($user){
              if((cookie('yd_merchantsuser')['0'] != $user['id']) || (time() - cookie('yd_merchantsuser')['2'] > cookie('yd_merchantsuser')['1'])){
                  cookie('merchantsuser',array($user['id'],$check,time()),array('expire'=>$check,'prefix'=>'yd_'));
              }
              session('merchantsuser',$user);
              $result['url'] = U('Index/index');
              $result['res'] = 1;
              $this->ajaxReturn($result);
            }else{
              $this->ajaxReturn('密码错误！');
            }

          }else{
            $this->ajaxReturn('用户名不存在！');
          }

        }else{


        }
      }else{
          $this->assign('title','用户登录');
          $this->display();
      }

    
  }
       /*生成验证码*/
       public function img(){ //取消了
           $Verify = new \Think\Verify();
           $Verify->entry();
       }

       /**
        * 用户注册
        *@author 周飞
        */
       public function register()
       {
            if(IS_POST){
                $pattern = "/^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/";
                if(!preg_match($pattern,I('post.phone'))){ $this->redirect('register',array('error'=>'手机号码不合法！'));}
                if(!I('post.keyword') || !I('post.keywords')){ $this->redirect('register',array('error'=>'密码不能为空！'));}
                if(I('post.keyword') != I('post.keywords')){ $this->redirect('register',array('error'=>'密码不一致！'));}
                if(S('code.'.I('post.phone').'.code') != I('post.code')){ $this->redirect('register',array('error'=>'验证码错误！'));}
               $user_m = M('Users');
               $pwd = md5(I('post.keywords'));//用户密码
               $phone = $data['mobile'] = I('post.phone');//手机号
               $data2['password_rand'] = $data['password_rand'] = md5(createluan(15));//密码随机窜
               $data2['password'] = $data['password'] = md5($pwd.$data['password_rand']);//正式密码
               if(I('post.modify')){
                    $users = $user_m->where('mobile = '.$phone)->save($data2);
               }else{

                    $users = $user_m->add($data);
               }
               if($users){
                $this->redirect('login');
               }else{
                $this->redirect('register',array('error'=>'服务器繁忙！请稍后再试！'));
               }

            }else{
                    $this->assign('title','用户注册');
                    $this->display();
            }
       }

       /**
        * 发送验证码
        *@author 周飞
        */
       public function code()
       {
            if(IS_AJAX){
                $phone = I('post.phone');
                if(I('post.p') == '1'){$sms = 'SMS_25660338';}elseif(I('post.p') == '2'){$sms = 'SMS_25585333';}//模板
                $pattern = "/^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/";
                if(!preg_match($pattern,$phone)){$this->ajaxReturn('手机号码不合法！');}
                if((time() - S('code.'.$phone.'.time')) < 60 ){$this->ajaxReturn('验证码一分钟只能发送一次！还有'.(60 - (time() - S('code.'.$phone.'.time'))).'秒！');}
                $res = Alicode($phone,$sms,'云狄网络');//
                if($res){
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn('发送失败！');
                }
                
            }else{

                $this->_empty();
            }
       }


       /**
        * 验证码验证
        *@author 周飞
        */
       public function validation()
       {
            if(IS_AJAX){
                $phone = I('post.phone');
                $this->ajaxReturn(S('code.'.$phone.'.code'));
            }else{

                $this->_empty();
            }
       }




       /**
        * 找回密码
        *@author 周飞
        */
       public function back()
       {
            // 修改密码和注册一起

            $this->display();
       }


       //用户验证 用户是否存在
       public function user()
       {
          if(IS_AJAX){
              $user_m = M('Users');
              $phone['mobile'] = I('post.phone');
              $res = $user_m->where($phone)->getField('id');
              if($res){
                $this->ajaxReturn(1);
              }else{
                $this->ajaxReturn('手机号不存在！');
              }

          }else{

            $this->_empty();
          }
       }

       public function _empty()
       {
         echo '404';
       }
    
}

