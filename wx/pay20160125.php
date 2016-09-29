<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>账号绑定</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
<div class="page">
    <div class="hd">
        <h1 class="page_title">一杆秤麻辣烫</h1>
    </div>
    <div class="bd">

        <div class="weui_cells_title">账号信息如下所示：</div>
        <div class="weui_cells">

            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>手机号码</p>
                </div>
                <div class="weui_cell_ft">13701747275</div>
            </div>
          
        </div>

        <div class="weui_cells_title">充值信息</div>
        <div class="weui_cells">


            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">充值金额</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" style="text-align:right;" type="tel" placeholder="￥"/>
                </div>
            </div>          
        </div>


        <div class="weui_cells_tips">充值金额，可以在平时进行消费。</div>
        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">立即支付</a>
        </div>  



    </div>
</div>
        
    <script src="./jquery-1.7.2.min.js"></script>
    <script src="./example.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script type="text/javascript">
    $(document).ready(function(){
                 
    });


  wx.config({
    //这里如果设置为true,会自动弹出很多提示信息
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'chooseWXPay'
      
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareTimeline({
        title: '一杆秤麻辣烫', // 分享标题
        link: 'http://wx.xiaomutong.com.cn/pay.php', // 分享链接
        imgUrl: 'http://wx.xiaomutong.com.cn/logo/logo.jpg', // 分享图标
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareAppMessage({
        title: '一杆秤麻辣烫', // 分享标题
        desc: '我正在使用爱一杆秤...', // 分享描述
        link: 'http://wx.xiaomutong.com.cn/pay.php', // 分享链接
        imgUrl: 'http://wx.xiaomutong.com.cn/logo/logo.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    }); 
    wx.chooseWXPay({
        timestamp: <?php echo $signPackage["timestamp"];?>, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
        nonceStr: '<?php echo $signPackage["nonceStr"];?>', // 支付签名随机串，不长于 32 位
        package: '', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
        signType: 'MD5', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
        paySign: '', // 支付签名
        success: function (res) {
            // 支付成功后的回调函数
        }
    });

  });    
    </script>

    </body>
</html>