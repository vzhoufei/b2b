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
	namespace Org\Alicode;
	// include "TopSdk.php";
	date_default_timezone_set('Asia/Shanghai');
	$appkey = '23527420';
	$secret = '5f95047e86e45110b79d1c5bbee129f1';
	$code = mt_rand(000000,999999);
	$c = new TopClient;
	$c ->appkey = $appkey ;
	$c ->secretKey = $secret ;
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req ->setExtend( "" );
	$req ->setSmsType( "normal" );
	$req ->setSmsFreeSignName( $signature );
	$req ->setSmsParam( "{code:'$code',product:''}" );
	$req ->setRecNum( $phone );
	$req ->setSmsTemplateCode( $signature );
	$resp = $c ->execute( $req );
	return $resp;
	
}