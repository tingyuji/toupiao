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
$items=$mappingClass->getAll4();

foreach ($items as $item) {
  //usleep(5);
  $openid=$item['wxusername'];
  $username=$item['username'];
  $data=array(
         'touser'=>$openid,
         "msgtype"=>"text",
         'text'=>array(
            "content"=>"小伙伴们，提醒下，上传样图会被封号的，平台给大家一次申诉的机会。"
          )
                   
  );


  $json=json_encode($data,JSON_UNESCAPED_UNICODE);
  echo $json;
  echo "\n";

  $ret=$wechatObj->send_kefu_message($json); 
  var_dump($ret);
  echo "\n";
  $pid='';
  $title='';
  //$messge='亲，这次来大单了，人手一份';
  //$messge='亲，又有人发新任务了，来看看吧';
  //$messageClass->add($openid,$username,$pid,$title,$messge);             
  
}



?>








