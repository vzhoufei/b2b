<?php
namespace Merchants\Controller;
use Think\Controller;
class CommonController extends Controller 
{
    

    public function _initialize()
    {
    	if(!session('merchantsuser') and !cookie('yd_merchantsuser')){$this->redirect('User/login');}//如果session和cookie都不为真 去登录  周飞
    	//如果session不为真而cookie为真 查询一次当前用户存入session   周飞
    	if(!session('merchantsuser') and cookie('yd_merchantsuser')){
    		$user = M('Users');
    		session('merchantsuser',$user->where('id =%d',array(cookie('yd_merchantsuser')['0']))->find());
    	}
    }
}