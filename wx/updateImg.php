<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

$file=dirname(__FILE__).'/qrcode_for_gh_5919547bc9ed_430.jpg';
$data=array('media' => '@'.$file);
echo '<pre>';
print_r($data);

$data='
{
    "type":"image",
    "offset":0,
    "count":5
}
';
$ret=$wechatObj->updateImg($data);                  
var_dump($ret);
?>








