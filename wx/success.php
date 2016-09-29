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
        <title>登录成功</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
        <div class="page">
            <div class="weui_msg">
                <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
                <div class="weui_text_area">
                    <h2 class="weui_msg_title">登录成功</h2>
                </div>
                <div class="weui_opr_area">
                    <p class="weui_btn_area">
                        <a href="javascript:;" id="ok" class="weui_btn weui_btn_primary">开始预约</a>
                        <a href="javascript:;" id="cancel" class="weui_btn weui_btn_default">返回</a>
                    </p>
                </div>
               
            </div>
        </div>

        
    <script src="./jquery-1.7.2.min.js"></script>
    <script src="./example.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
            var url = $.url(); 
            var tel=url.param('tel'); 
            var openid=url.param('openid'); 
            var nickname=url.param('nickname'); 
                $.ajax({
                  type:'post',
                  url:"tel2.php", 
                  data:{
                    tel:tel,
                    openid:openid,
                    nickname:nickname

                  },
                  async:false,
                  success:function(data){   
                   

                  }

                }); 
            $('#ok').click(function(){
                window.location.href="order2.php";
            });
            $('#cancel').click(function(){
                wx.closeWindow();
            });            
    });


  wx.config({
    //这里如果设置为true,会自动弹出很多提示信息
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'onMenuShareTimeline',
      'onMenuShareAppMessage'
      
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareTimeline({
        title: '爱宝贝', // 分享标题
        link: 'wx.xiaomutong.com.cn/weui/index.php', // 分享链接
        imgUrl: 'wx.xiaomutong.com.cn/weui/logo/logo.png', // 分享图标
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareAppMessage({
        title: '爱宝贝', // 分享标题
        desc: '我正在使用爱宝贝...', // 分享描述
        link: 'wx.xiaomutong.com.cn/weui/index.php', // 分享链接
        imgUrl: 'wx.xiaomutong.com.cn/weui/logo/logo.png', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () { 
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    }); 
  });    
    </script>

    </body>
</html>