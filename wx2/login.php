<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxf26b83f0a766a32b","cafd55d65bbba76243e7de3dc46bdeb4");
if (isset($_GET['code'])){
    //echo $_GET['code'];
    $code=$_GET['code'];
    $token=$wechatObj->getAccessToken();
    $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf26b83f0a766a32b&secret=cafd55d65bbba76243e7de3dc46bdeb4&code='.$code.'&grant_type=authorization_code';
    //echo '<br>';
    //echo $url;
    $json=$wechatObj->sendGetData($url);
    //print_r($json);
    $item=json_decode($json, true);
    //print_r($item);
    $openid=$item['openid'];
   

    $token=$item['access_token'];
    //$token=$wechatObj->getAccessToken();

    require_once 'class/mili.class.php';
    $miliClass=new miliClass();
    $total=$miliClass->getCount2($openid);
    //$total=0;
    if($total){
        $items=$miliClass->getAll2($openid);
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

        $url='http://www.fangdan8.com/wxtp2/index.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl;
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

        $url='http://www.fangdan8.com/wxtp2/login.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl;
        echo $url;
        header('Location:'.$url);
        exit();

    }

		
}else{
    echo "NO CODE";
}
?>