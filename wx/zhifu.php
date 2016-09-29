<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");

require_once 'class/zhifu.class.php';

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379);

$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");
if (isset($_GET['code'])){
    //echo $_GET['code'];
    $code=$_GET['code'];
    $token=$wechatObj->getAccessToken();
    $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxdda2a0fe7a1637eb&secret=efb9b15278468609f611fb9f313844ca&code='.$code.'&grant_type=authorization_code';
    //echo '<br>';
    //echo $url;
    $json=$wechatObj->sendGetData($url);
    //print_r($json);
    $item=json_decode($json, true);
    //print_r($item);
    $openid=$item['openid'];

    $time=time();
    $redis->set($openid,$time);
   

    $token=$item['access_token'];



    $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
    $json=$wechatObj->sendGetData($url);
    //print_r($json);
    $item=json_decode($json, true);    
 
    $zhifuClass=new zhifuClass();
    $total=$zhifuClass->getCount2($openid);
    if($total==0){
        $url='http://www.fangdan8.com/wxzf/index.php?openid='.$openid;
        echo $url;
        header('Location:'.$url);
        exit();        
    }

    if($total>0){
        $url='http://www.fangdan8.com/wxzf/message.php?openid='.$openid;
        echo $url;
        header('Location:'.$url);
        exit();        
    }


    

		
}else{
    echo "NO CODE";
}
?>