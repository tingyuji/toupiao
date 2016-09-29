<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>支付</title>
        <link rel="stylesheet" href="../../node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="../../css/example.css"/>
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
        


        <div class="weui_cells_title">支付信息</div>
        <div class="weui_cells">


            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">应付金额</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" style="text-align:right;" type="input" name="fee" id="fee" placeholder="￥"/>
                </div>
            </div>  
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">预付金额</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" style="text-align:right;" type="input" name="fee" id="yufu" value="20"/>
                </div>
            </div>  

        </div>



        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" href="javascript:" id="ok">确定支付</a>
        </div>   
       


    </div>
</div>
        
    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog2" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
            <div class="weui_dialog_bd">支付成功</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->

    <script src="../../jquery-1.7.2.min.js"></script>
    <script src="../../example.js"></script>
    <script type="text/javascript" src="../../js/purl.js"></script> 
        <script src="http://cdn.haimati.cn/MobileStatic/js/jquery.cookie.js" type="text/javascript"></script>
    <script type="text/javascript">
   function toVaild(){ 
        var fee=$('#fee').val();
        if(fee==''){
            alert('请输入充值金额');
            $('#fee').focus();
            return false;
        }
        if(fee=='￥'){
            alert('请输入充值金额');
            $('#fee').focus();
            return false;
        } 
        if(isNaN(fee)){
            return true;
        }           
    }        
    $(document).ready(function(){

        var url = $.url();
        var fee=url.param('fee');
        var orderid=url.param('orderid');
        //alert(orderid);
        $.cookie('orderid',orderid);
        $('#fee').val(fee);
        $.ajax({
              type:'post',
              url:"setFee.php", 
              data:{
                fee:fee      
              },
              async:false,
              success:function(msg){  

              }
        });
        $('#ok').click(function(){
            window.location.href='pay2.php';
        });
        $('#fee').blur(function(){
            var fee=$('#fee').val();
            alert(fee);
            $.ajax({
              type:'post',
              url:"setFee.php", 
              data:{
                fee:fee      
              },
              async:false,
              success:function(msg){  

              }
              });
        });
    });

    
    </script>
    </body>
</html>