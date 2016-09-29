<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

$jsonMenu='{
     "button":[

      {
           "type":"click",
           "name":"收米",
           "key":"key1"   
      },
      {
           "type":"click",
           "name":"交粮",
           "key":"key2"   
      },   
      {
           "name":"米仓",
           "sub_button":[
           {    
           		"type":"click",
           		"name":"登陆",
          		"key":"login"               
            }, {  
                "type":"view",
                "name":"注册",
                "url":"http://www.fangdan8.com/wxwb/register.php"
            }]
       }
    ]
 }';

$ret=$wechatObj->createMenu($jsonMenu);                  
var_dump($ret);
?>








