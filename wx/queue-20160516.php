<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

require_once 'class/mapping.class.php';


$mappingClass=new mappingClass();
$items=$mappingClass->getAll8();
echo '<pre>';
print_r($items);
//exit();



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
  $username=$item['username'];
  $wxusername=$item['wxusername'];
  $status=$redis->get($username);
  if($status==0){
  	$redis->set($username,'1');
  	$redis->lPush('openid',$wxusername);
  }

}
 

  




?>








