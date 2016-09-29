<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>会员充值</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
<div class="page">
    <div class="hd">
        <h1 class="page_title">留年映画照相馆</h1>
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
                    <input class="weui_input" style="text-align:right;" type="tel"   id="fee" placeholder="￥"/>
                </div>
            </div>          
        </div>


        <div class="weui_cells_tips">充值金额，可以在平时进行消费。</div>
        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" href="javascript:" id="ok">确定</a>
        </div>  



    </div>
</div>
        
    <script src="./jquery-1.7.2.min.js"></script>
    <script src="./example.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script type="text/javascript">
    $(document).ready(function(){
        $('#ok').click(function(){
            var fee=$('#fee').val();
            var url=encodeURI('http://xiaomutong.com.cn/wx2/paysdk/example/pay.php?fee='+fee);
            window.location.href=url;
        });
    });

  
    </script>

    </body>
</html>