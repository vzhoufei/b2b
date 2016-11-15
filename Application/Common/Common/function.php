<?php

/**
 * 阿里大鱼 手机验证码发送
 *@param $phone 手机号
 *@param $sms 模板id
 *@param $signature 签名名称
 *@author 周飞
 * Alicode('13539993040','SMS_25660338','云狄网络');
 */ 
function Alicode($phone,$sms,$signature){
	import("Org.Alicode.TopSdk");
	date_default_timezone_set('Asia/Shanghai');
	$appkey = '23527420';
	$secret = '5f95047e86e45110b79d1c5bbee129f1';
	$code = mt_rand(000000,999999);
	$c = new \TopClient;
	$c ->appkey = $appkey ;
	$c ->secretKey = $secret ;
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req ->setExtend(  );
	$req ->setSmsType( "normal" );
	$req ->setSmsFreeSignName( $signature );
	$req ->setSmsParam( "{code:'$code',product:''}" );
	$req ->setRecNum( $phone );
	$req ->setSmsTemplateCode( $sms );
	$resp = $c ->execute( $req );
	$true = $resp->result->success;
	if($true){
	S('code.'.$phone.'.code',$code,1800);
	S('code.'.$phone.'.time',time(),1800);
		return true;
	}else{

		return false;
	}
	
}




 /**
     * 生成随机字符串
     */
	function createluan($length){
		$str = '0123456789abcdefghijklmnopqrstuvwxyz'; //62个字符
		$strlen = 36; 
		while($length > $strlen){
			$str.= $str;
			$strlen += 36;
		}
		$str = str_shuffle($str); //随机打乱
		return mck.substr($str,mt_rand(6,30),$length); 
	}