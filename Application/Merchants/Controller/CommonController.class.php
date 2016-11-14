<?php
namespace Merchants\Controller;
use Think\Controller;
class CommonController extends Controller 
{
    

    public function _initialize()
    {
    	if(!session('userid')){$this->redirect('User/index');}
    }
}