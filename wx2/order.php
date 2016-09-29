<!DOCTYPE html>
<!-- saved from url=(0034)http://www.haimati.cn/Mobile/order -->
<html data-dpr="1" style="font-size: 33.75px; min-height: 675px;"><head lang="en"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0, user-scalable=0">
    <link href="base.css" rel="stylesheet">
    
        <title>留年映画照相馆-我的订单</title>
        <link href="http://cdn.haimati.cn/MobileStatic/css/dist/order.css" rel="stylesheet">
    
<link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script></head>
<body gtools_scp_screen_capture_injected="true" style="min-height: 675px; font-size: 12px;">
    
        <div class="main" id="items">
            <div class="order-info">
                <div class="top">
                    <p class="order-num">订单号：<span>2016012815795556</span></p>
                    <p class="status">
                        已关闭  
                    </p>
                </div>
            </div>        
        </div>
        
<div class="bottom-banner" id="bottom-banner">
    <div class="bottom-fix">

        <div class="reservation-banner"></div>
        <div class="reservation-banner"><a class="f-tap" href="http://www.xiaomutong.com.cn/wx2/step0.php"><img src="./step0_files/m-reservation-banner.png"></a></div>
        <div class="personal-banner"><a class="f-tap" href="http://www.xiaomutong.com.cn/wx2/personalCenter.php"><img src="./step0_files/m-personal-banner.png"></a></div>
        <div class="reservation-banner"></div>
    </div>
</div>
    
    <script src="./order_files/hm.js"></script><script>
        var module = '';
        var m_static = 'http://cdn.haimati.cn/MobileStatic';
    </script>
    <script src="./order_files/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="./order_files/jquery.cookie.js" type="text/javascript"></script>
    <script src="./order_files/base.js"></script>
    <script src="./order_files/mbase.js"></script>
    
<script type="text/javascript">
$(document).ready(function(){
    var openid=$.cookie('openid');
    $.ajax({
        type:'post',
        url:'getorderByopenid.php',
        data:{
            openid:openid
        },
        async:false,
        dataType:'json',
        success:function(data){
            var total=data.total;
            alert(total);
            
            var rows=data.rows;

            $('#items').html('');

            for(var i=0;i<total;i++){
                var row=rows[i];
                var orderid=row['orderid'];
                var status=row['status'];
                var html='<div class="order-info">';
                        html+='<div class="top">';
                            html+='<p class="order-num">订单号：<span>'+orderid+'</span></p>';
                            html+='<p class="status">'+status+'</p>';
                        html+='</div>';
                    html+='</div>';
                    $('#items').append(html);
            }
            
        }
    });
});
</script>

</body>
</html>