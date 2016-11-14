<?php


namespace Home\Model;
use Think\Model;

class UserModel extends Model
{

	public function datas($post)
	{
		$data = array(
			 'name'		 		 =>				$post['store_name'],  		//网站名称       
			 'title'			 =>				$post['store_title'],  		//标题
			 'keywords'			 =>				$post['store_keyword'],  	//关键字
			 'description'		 =>				$post['store_desc'],  		//描述
			);
		return $data;
	}
	
		

}
 