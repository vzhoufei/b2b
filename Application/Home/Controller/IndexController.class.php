<?php
namespace Home\Controller;
use Think\Controller;
/**
* @author 金龙
* 2016-11-14
* 首页控制器
*/

class IndexController extends Controller
{
	public function Index(){
		C('TOKEN_ON',false);
		$this->display('/index');
	}
}