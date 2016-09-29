<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");

$file=dirname(__FILE__).'/logo.jpg';
$data=array('media' => '@'.$file);
//echo '<pre>';
//print_r($data);
$ret=$wechatObj->updateImg($data);  
//var_dump($ret);
$media_id=$ret['media_id'];
$data=$data=$wechatObj->downloadImg($media_id);    
$newefile='newfile.jpg';
$wechatObj->writeFile($newfile,$data);   

?>








