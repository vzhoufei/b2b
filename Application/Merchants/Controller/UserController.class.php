<?php
/*
*   创建 2016-11-05 
*   用户模块User
*/
namespace Merchants\Controller;
use Think\Controller;
Class UserController extends Controller{

    public function index(){
        if(!isset($_SESSION['userid'])||$_SESSION['userid']==''){

            //未登录，从cookie获取
            $login = false;
            if(!empty($_COOKIE['user'])){

                //有COOKIE存在
                //读取解密COOKIE
                $array = json_decode(decrypt($_COOKIE['user'],'yd'));


                //cookIE有效
                if(time()<$array->eff){

                    $_SESSION['userid'] = M('user')->where('userid = '.$array->InfoId)->getField('userid');

                    $login = true;

                }

            }

        }else{
            //登录中
            $login = true;
        }


        ($login)?$this->success('无需重复登录',U('index/index'),3):$this->display('login');

    }

    public function Authentication(){

        $result = array(
            //接口类型
            'status' =>   0,// <0 为异常
            'Msg'    =>   '登录成功'
            );

        $User = M("User");

        $where = array(
            'account'   =>      $_POST['account'],
            'password'  =>  md5($_POST['password'])
            );

        $InfoId = $User->where($where)->getField('userid');

        if($InfoId==''){

            $result['status'] = -1;
            $result['Msg']    = '账号或密码错误';

        }else{

            if($_POST['check']=='true'){

                $string = array(
                    'InfoId' => $InfoId,
                    'eff'    => time()+30
                    /*'eff'    => time()+604800*/
                    );
                setcookie('user',encrypt(json_encode($string),'yd'),$string['eff'],'/');
            }

            $_SESSION['userid'] = $InfoId;
            $result['url'] = U('index/index');
        }
        echo json_encode($result);

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
                if(!I('post.password') || !I('post.passwords')){ $this->redirect('register',array('error'=>'密码不能为空！'));}
                if(I('post.password') != I('post.passwords')){ $this->redirect('register',array('error'=>'密码不一致！'));}
                dump($_POST);
            }else{
                    $this->display();
            }
       }
    
}