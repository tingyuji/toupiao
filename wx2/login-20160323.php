<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wx3edcd4111b348882","89f0c4da4af63f0019cf9d9086bc39f4");
if (isset($_GET['code'])){
    //echo $_GET['code'];
    $code=$_GET['code'];
    $token=$wechatObj->getAccessToken();
    $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx3edcd4111b348882&secret=89f0c4da4af63f0019cf9d9086bc39f4&code='.$code.'&grant_type=authorization_code';
    //echo '<br>';
    //echo $url;
    $json=$wechatObj->sendGetData($url);
    //print_r($json);
    $item=json_decode($json, true);
    //print_r($item);
    $openid=$item['openid'];
   

    $token=$item['access_token'];
    //$token=$wechatObj->getAccessToken();

    require_once 'class/mapping.class.php';
    $mappingClass=new mappingClass();
    $total=$mappingClass->getCount2($openid);
    echo $total;
    exit();
    //$total=0;
    if($total){
        $items=$mappingClass->getAll2($openid);
        $item=$items[0];
        $nickname=$item['nickname'];
        $headimgurl=$item['headimgurl']; 
        $id=$item['id'];
        $username=$item['username'];
        session_start();
        $_SESSION['username']=$username;
        $_SESSION['id']=$id;

        $url='http://www.toupiaovip.com/xiniuwx/index.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl;
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

        $url='http://www.toupiaovip.com/xiniuwx/login.php?openid='.$openid.'&nickname='.urlencode($nickname).'&headimgurl='.$headimgurl;
        echo $url;
        header('Location:'.$url);
        exit();

    }

		
}else{
    echo "NO CODE";
}
?>