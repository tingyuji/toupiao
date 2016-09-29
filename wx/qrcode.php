<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");


/*
{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}


$json='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}';

*/
$data=array(
       "action_name"=>"QR_LIMIT_SCENE",
       "action_info"=>array(
          "scene"=>array(
            "scene_id"=>"abc"
          )
        )
                 
);


$json=json_encode($data,JSON_UNESCAPED_UNICODE);




// echo $json;
// echo "\n";

$ret=$wechatObj->createQrCode($json);                  
// var_dump($ret);

$ticket=$ret['ticket'];
$wechatObj->showqrcode($ticket);
?>








