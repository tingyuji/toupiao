<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");


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
    //$token=$wechatObj->getAccessToken();

    require_once 'class/mapping.class.php';
    $mappingClass=new mappingClass();
    $total=$mappingClass->getCount2($openid);
    //$total=0;
    if($total){
        $items=$mappingClass->getAll2($openid);
        $item=$items[0];
        $nickname=$item['nickname'];
        $headimgurl=$item['headimgurl']; 
        $id=$item['id'];
        $username=$item['username'];



        $inviteCode=$item['inviteCode'];
        session_start();
        $_SESSION['username']=$username;
        $_SESSION['id']=$id;
        $_SESSION['inviteCode']=$inviteCode;

        $url='http://www.fangdan8.com/wxwb/index.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl;
        echo $url;
        header('Location:'.$url);
        exit();
    }
    if($total==0){
        $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        $json=$wechatObj->sendGetData($url);
        //print_r($json);
        $item=json_decode($json, true);    
        //print_r($item);
        $nickname=$item['nickname'];
        $headimgurl=$item['headimgurl'];


        //20160501
        $sex=$item['sex'];
        $province=$item['province'];
        $city=$item['city'];

        $url='http://www.fangdan8.com/wxwb/login.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl.'&sex='.urlencode($sex).'&province='.urlencode($province).'&city='.urlencode($city);
        echo $url;
        header('Location:'.$url);
        exit();

    }

		
}else{
    echo "NO CODE";
}
?>