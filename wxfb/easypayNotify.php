<?php
/************************************
Author		: 老曹
Time		: 2014.12.23
Version		: V1.0
Description : 支付宝自动交易异步通知接口文件.
************************************/

setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


$key = '123456';//通信秘钥，跟easyPay.exe上填写的接口秘钥保持一致

$sig = $_POST['sig'];//签名
$tradeNo = $_POST['tradeNo'];//交易号
$desc = $_POST['desc'];//交易名称（付款说明）
$time = $_POST['time'];//付款时间
$username = $_POST['username'];//客户名称
$userid = $_POST['userid'];//客户id
$amount = $_POST['amount'];//交易额
$status = $_POST['status'];//交易状态

require_once 'class/taobao.class.php';
$taobao=new taobaoClass();
$taobao->add($tradeNo,$desc,$time,$username,$userid,$amount,$status);

//验证签名
if(strtoupper(md5("$tradeNo|$desc|$time|$username|$userid|$amount|$status|$key")) == $sig){
//if(1){
	//这里做订单业务，在下面写您的代码即可
	
	echo "ok";
	echo '<br>';

}
else
	echo "签名错误";

?>