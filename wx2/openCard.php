<?php
require_once "jssdk.php";

$appId="wxce3d90673ffbf8d0";
$appSecret="d785468bee4066104f11ba849012b7f8";

$jssdk = new JSSDK("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");
$signPackage = $jssdk->GetSignPackage();

//$apiTicket=$signPackage['apiTicket'];
$nonceStr=$signPackage['nonceStr'];
$timestamp=$signPackage['timestamp'];

//echo '<pre>';
//print_r($signPackage);

require_once "cardSDK.php";
$signature = new Signature();

$apiTicket=$signature->getTicket();
$signature->add_data($apiTicket);
$signature->add_data($appId);
$signature->add_data($nonceStr);
$signature->add_data($timestamp);
//$signature->add_data("");
//$signature->add_data( "" );
$cardSignature= $signature->get_signature();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>卡券列表</title>
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
                    <h2 class="weui_msg_title">卡券列表</h2>
                </div>
                <div class="weui_opr_area">
                    <p class="weui_btn_area">
                        <a href="javascript:;" id="chooseCard" class="weui_btn weui_btn_primary">确定</a>
                        <a href="javascript:;" id="ok" class="weui_btn weui_btn_default">返回</a>
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

            $('#ok').click(function(){
                wx.closeWindow();
            });
            $('#cancel').click(function(){
                window.history.back();
            });            
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
      
        'addCard',
        'chooseCard',
        'openCard'
      
    ]
  });
  wx.ready(function () {
    // 在这里调用 API

  // 12 微信卡券接口
  // 12.1 添加卡券
  $('#chooseCard').click(function(){
    wx.chooseCard({
      appId: '<?php echo $signPackage["appId"];?>',
      cardSign: '<?php echo $cardSignature;?>',
      timestamp:'<?php echo $timestamp;?>',
      nonceStr: '<?php echo $nonceStr;?>',
      //cardId: 'pXi3vszy5NpEZ_tHidk1rAIGgs_w',
      signType: 'SHA1',
      success: function (res) {
        alert(res);
        res.cardList = JSON.parse(res.cardList);
        encrypt_code = res.cardList[0]['encrypt_code'];
        alert('已选择卡券：' + JSON.stringify(res.cardList));
        decryptCode(encrypt_code, function (code) {
          codes.push(code);
        });
      }
    });
  
  });

    
  });    
    </script>

    </body>
</html>