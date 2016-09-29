<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

$data='
{
    "touser":"o6-UVwu-KtCsLBuk2jtc-Sac8rL0",
    "msgtype":"text",
    "text":
    {
         "content":"Hello World"
    }
}
';


  //usleep(5);
  $openid='o6-UVwu-KtCsLBuk2jtc-Sac8rL0';
  $data=array(
         'touser'=>$openid,
         "msgtype"=>"text",
         'text'=>array(
            "content"=>"有任务被投诉了"
          )
                   
  );



  $json=json_encode($data,JSON_UNESCAPED_UNICODE);
  //echo $json;
  //echo "\n";

  $ret=$wechatObj->send_kefu_message($json); 
  var_dump($ret);
  echo "\n";

  exit();

            
  


echo '发送成功';
echo '<br>';


?>








