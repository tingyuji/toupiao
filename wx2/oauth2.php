<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");
if (isset($_GET['code'])){
    //echo $_GET['code'];
    $code=$_GET['code'];
    $token=$wechatObj->getAccessToken();
    $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxce3d90673ffbf8d0&secret=d785468bee4066104f11ba849012b7f8&code='.$code.'&grant_type=authorization_code';
    //echo '<br>';
    //echo $url;
    $json=$wechatObj->sendGetData($url);
    //print_r($json);
    $item=json_decode($json, true);
    $openid=$item['openid'];

    //$token=$item['access_token'];
    //$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
    //$json=$wechatObj->sendGetData($url);
    //$item=json_decode($json, true);    
    //$nickname=$item['nickname'];

    $url='http://www.xiaomutong.com.cn/wx2/login.php?openid='.$openid;

    header('Location:'.$url);
    exit();		
}else{
    echo "NO CODE";
}
?>