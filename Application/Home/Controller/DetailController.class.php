<?php
namespace Home\Controller;
use Think\Controller;
/**
* @author 金龙
* 2016-11-14
* 产品页控制器
*/

class DetailController extends Controller{
	public function index(){
		C('TOKEN_ON',false);
		$this->display('/Details');
	}
}