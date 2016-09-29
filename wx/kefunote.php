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


require_once 'class/items.class.php';


$itemsClass= new itemsClass();



$items=$itemsClass->getAll();

$i=0;
foreach ($items as $item) {
  //usleep(5);
  $i++;
  echo $i;
  echo "\n";
  $openid=$item['openid'];
  $data=array(
         'touser'=>$openid,
         "msgtype"=>"text",
         'text'=>array(
		'content'=>'您已封号，如有委屈，请联系紫萱，扣扣1621839728。'
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








