<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

$data='
{
    "touser":"o8lYfuF0mwrkwEHOy3NBfVksHXM0",
    "msgtype":"text",
    "text":
    {
         "content":"Hello World"
    }
}
';


require_once 'class/mapping.class.php';
require_once 'class/task.class.php';
require_once 'class/message.class.php';

$mappingClass= new mappingClass();
$taskClass= new taskClass();
$messageClass= new messageClass();


$orderCount=1;
$items=$mappingClass->getAll();


foreach ($items as $item) {
  //usleep(5);
  $openid=$item['wxusername'];
  $username=$item['username'];
  $data=array(
         'touser'=>$openid,
         "msgtype"=>"image",
         'image'=>array(
            "media_id"=>"43JnhWI18AThLj7STx9mKwbz-j2MBUjBhUQUQeOV-ng"
          )
                   
  );


  $json=json_encode($data,JSON_UNESCAPED_UNICODE);
  echo $json;
  echo "\n";

  $ret=$wechatObj->send_kefu_message($json); 
  var_dump($ret);
  echo "\n";

            
  
}



?>








