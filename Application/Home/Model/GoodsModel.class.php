<?php
namespace Home\Model;
use Think\Model;
/**
* @author 金龙
*/
class GoodsModel extends Model
{
	private static $page = 10;


	public function __set($name,$num){

		($num<1)?$num=1:$num=$num;
		$this->$name = $num;

	}
	public function like($keyword){

		$sql['name']  = array('like', "%$keyword%");
		$sql['keywords']  = array('like',"%$keyword%");
		$sql['description']  = array('like',"%$keyword%");
		$sql['_logic'] = 'or';
		$where['_complex'] = $sql;
		$where['is_on_sale'] = 0;

		$count = $this->where($where)->count();
		$Page  = new \Think\Page($count,$this->page);
		return array(
			'data'	=>	$this->where($where)->limit($Page->firstRow.','.$Page->listRows)->select(),
			'page'	=>	$Page->show()
			);
	}
}