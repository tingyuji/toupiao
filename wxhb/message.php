
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>提现</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
        <div class="page">
            <div class="weui_msg">
                <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
                <div class="weui_text_area">
                    <h2 class="weui_msg_title">操作成功</h2>
                    <p class="weui_msg_desc">请按确定查看自己的到账明细</p>
                </div>
                <div class="weui_opr_area">
                    <p class="weui_btn_area">
                        <a href="javascript:;" id="ok" class="weui_btn weui_btn_primary">确定</a>
                      
                    </p>
                </div>
               
            </div>
        </div>


    <script src="js/jquery-1.7.2.min.js"></script>
        
    <script type="text/javascript">
      
    $(document).ready(function(){
        $('#ok').click(function(){
            wx.closeWindow();
        });
        
    });

    
    </script>


</body>
</html>