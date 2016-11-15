<?php 
namespace home\Controller;
use Think\Controller;
/**
* 2016年11月15日
* @author 金龙
* 
*/
class ProductController extends Controller
{
	public function index(){
		C('TOKEN_ON',false);
		(isset($_GET['keyword']))?$keyword = $_GET['keyword']:$keyword='';
		
		$goods = D('Goods');
		$goods->page = 24;
		$data  = $goods->like($keyword);


		$this->assign('keyword',$keyword);
		$this->assign('goods',$data);
		$this->display('/products');
	}
}