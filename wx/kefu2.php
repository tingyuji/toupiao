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



  
  $openid='o6-UVwsGkZX0mOMg3gmtWz2_tkKU';
  $data=array(
         'touser'=>$openid,
         "msgtype"=>"text",
         'text'=>array(
            "content"=>"请认真上图哦，我们注意您很久了哦。小时光"
          )
                   
  );


  $json=json_encode($data,JSON_UNESCAPED_UNICODE);
  echo $json;
  echo "\n";

  $ret=$wechatObj->send_kefu_message($json); 
  var_dump($ret);
  echo "\n";



?>








