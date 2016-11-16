<?php
namespace Merchants\Controller;
use Think\Controller;

/**
* @author 
* 2016-11-15
* 商户首页
*/
class PublicController extends CommonController 
{
	
    
    //默认显示的首页
    public function index()
    {
    	$this->display();
    }



    //头部
    public function header()
    {
    	$this->display('Public/header');
    }


    //左边栏
    public function left()
    {

    	$this->display('Public/left');
    }
}