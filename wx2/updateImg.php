<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxf26b83f0a766a32b","cafd55d65bbba76243e7de3dc46bdeb4");

$file=dirname(__FILE__).'/lqrcode_for_gh_52c7318ebe6b_430.jpg';
$data=array('media' => '@'.$file);
echo '<pre>';
print_r($data);

$data='
{
    "type":"image",
    "offset":0,
    "count":2
}
';
$ret=$wechatObj->updateImg($data);                  
var_dump($ret);
?>








