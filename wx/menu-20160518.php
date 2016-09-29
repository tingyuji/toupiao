<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

$jsonMenu='{
     "button":[

      {
           "type":"click",
           "name":"接任务",
           "key":"key1"   
      },
      {
           "type":"click",
           "name":"交任务",
           "key":"key2"   
      },   
      {
           "name":"个人中心",
           "sub_button":[           
            {    
              "type":"click",
              "name":"今日战果",
              "key":"key4"               
            },           
            {    
              "type":"click",
              "name":"提现",
              "key":"key3"               
            }

          ]
       }
    ]
 }';

$ret=$wechatObj->createMenu($jsonMenu);                  
var_dump($ret);
?>








