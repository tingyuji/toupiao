<?php 
/*
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "./paysdk/lib/WxPay.Api.php";
require_once "./paysdk/WxPay.JsApiPay.php";
require_once './paysdk/log.php';

//初始化日志
$logHandler= new CLogFileHandler("./paysdk/logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("test");
$input->SetAttach("test");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee("1");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
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
            <a class="weui_btn weui_btn_primary" href="javascript:" onclick="callpay()" id="showTooltips">立即支付</a>
        </div>  



    </div>
</div>
        
    <script src="./jquery-1.7.2.min.js"></script>
    <script src="./example.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters; ?>,
            function(res){
                WeixinJSBridge.log(res.err_msg);
                alert(res.err_code+res.err_desc+res.err_msg);
            }
        );
    }

    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
    </script>
    <script type="text/javascript">
    //获取共享地址
    function editAddress()
    {
        WeixinJSBridge.invoke(
            'editAddress',
            <?php echo $editAddress; ?>,
            function(res){
                var value1 = res.proviceFirstStageName;
                var value2 = res.addressCitySecondStageName;
                var value3 = res.addressCountiesThirdStageName;
                var value4 = res.addressDetailInfo;
                var tel = res.telNumber;
                
                alert(value1 + value2 + value3 + value4 + ":" + tel);
            }
        );
    }
    
    window.onload = function(){
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', editAddress, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', editAddress); 
                document.attachEvent('onWeixinJSBridgeReady', editAddress);
            }
        }else{
            editAddress();
        }
    };
    
    </script>

    </body>
</html>