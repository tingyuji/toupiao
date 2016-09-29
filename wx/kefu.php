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



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 



while (true) {

  sleep(2);
  echo date("Y-m-d H:i:s");
  echo "\n";
    
  $OOXX=$redis->rPop('OOXX');

  $arr=explode("#",$OOXX);
  $len=count($arr);

  $openid=$arr[0];

  $pid = isset($arr[1]) ? intval($arr[1]) : '';
  if($len==2){

    
     // $openid='o6-UVwu-KtCsLBuk2jtc-Sac8rL0';
      $data=array(
             'touser'=>$openid,
             "msgtype"=>"text",
             'text'=>array(
                "content"=>"编号为".$pid."的任务被投诉了"."\n\n"."温馨提示："."\n\n"."对于MP任务，需要提交勾选图和已选图两张截图，在提交任务截图的时候，一定要等收到平台回复的两条信息之后，再回复数字0，否则由于平台未收到任务截图导致的投诉，平台概不负责。"."\n\n"."备注："."\n\n"."如需申诉请进扣扣群151640542联系紫萱。"
              )
                       
      );


    $json=json_encode($data,JSON_UNESCAPED_UNICODE);
    echo $json;
    echo "\n";

    $ret=$wechatObj->send_kefu_message($json); 
    var_dump($ret);
    echo "\n";    
  }

}




echo '发送成功';
echo '<br>';


?>








