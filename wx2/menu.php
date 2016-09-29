<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxf26b83f0a766a32b","cafd55d65bbba76243e7de3dc46bdeb4");

$jsonMenu='{
     "button":[

      {
           "type":"click",
           "name":"提现申请",
           "key":"key1"   
      },
      {
           "type":"click",
           "name":"关于我们",
           "key":"key2"   
      }
    ]
 }';

$ret=$wechatObj->createMenu($jsonMenu);                  
var_dump($ret);
?>








