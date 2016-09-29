<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<!-- saved from url=(0021)http://m.tlzx.cc/tel/ -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <title>微信图片操作</title>

	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
     



</head>
<body>
<div class="upload clearfix">
   <div>请上传图片</div>
    <div class="upload_area clearfix">
        <ul id="imglist" class="post_imglist">
        </ul>
        <div class="upload_btn">
        <button id="chooseImage" class="btn btn_primary">选择图片</button>
        <button id="previewImage" class="btn btn_primary">预览图片</button>
        <button id="uploadImage" class="btn btn_primary">上传图片</button>
        <button id="downloadImage" class="btn btn_primary">下载图片</button>
        </div>
    </div>
</div>
   

<script type="text/javascript" src='jquery-1.7.2.min.js'></script>

<script type="text/javascript">
    var viewImg = $("#imglist");
    var imgIndex = 0;
    var i = 0;
    var length = 0;
  wx.config({
	//这里如果设置为true,会自动弹出很多提示信息
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',

    jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
  });
  </script>
  <script type="text/javascript" src='zepto.min.js'></script>
  <script type="text/javascript" src='demo.js'></script>
	

 

</body>
</html>