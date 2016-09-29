<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.php"); //重新定向到其他页面
    exit();
}
?>

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
    <div class="hd">
        <h1 class="page_title">赚米吧</h1>
    </div>
    <div class="bd">
        


        <div class="weui_cells_title">佣金满一元可提现</div>
        <div class="weui_cells">

            <!--
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">可提金额</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input disabled="disabled" class="weui_input" style="text-align:right;" type="input" name="total" id="total" placeholder=""/>
                </div>
            </div>  
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">提现金额</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input disabled="disabled" class="weui_input" style="text-align:right;" type="input" name="fee" id="fee" value=""/>
                </div>
            </div>  
            -->

        </div>

        
        <div class="weui_cells_title"><span style="color:#F00;">网络太卡，晚点开放，佣金发放到29号下午</span></div>
        <div class="weui_cells_title"><span style="color:#F00;">之前佣金未到账的，请查看自己是否绑定，绑定方式为：底部菜单：：个人中心-绑定</span></div>
        
        <!--
        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" href="javascript:" id="ok">提交</a>
        </div>
        -->
        
    

    

        


        
         
    
       
        
       


    </div>
</div>
    <!--BEGIN dialog1-->
    <div class="weui_dialog_alert" id="dialog1" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
            <div class="weui_dialog_bd">请输入提现金额</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog1-->

    <!--BEGIN dialog2-->
    <div class="weui_dialog_alert" id="dialog2" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
            <div class="weui_dialog_bd">提现申请成功</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog2-->

    <!--BEGIN dialog3-->
    <div class="weui_dialog_alert" id="dialog3" style="display: none;">
        <div class="weui_mask"></div>
        <div class="weui_dialog">
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
            <div class="weui_dialog_bd">提现金额输入不符合规范，不予提现</div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
            </div>
        </div>
    </div>
    <!--END dialog3-->

    <script src="js/jquery-1.7.2.min.js"></script>
        
    <script type="text/javascript">
      
    $(document).ready(function(){

        /*

        $.ajax({
             type: "POST",
             url: "getSum.php",
             data: {

             },
             dataType: "json",
             success: function(data){
                //console.log(data);
                var username=$('#username').val();

                var sum=data[username]||0;
                
                $('#total').val(sum);
                $('#fee').val(sum);
             }
        });
        $('#ok').click(function(){
            var fee=$('#fee').val();
            //if(fee>10){
            //    alert('请联系管理员下发佣金');
            //    return;
            //}
            var total=$('#total').val();
            var username=$('#username').val();
            //alert(fee);
            if(fee==''){
                var $dialog = $('#dialog1');
                $dialog.show();
                $dialog.find('.weui_btn_dialog').on('click', function () {
                    $dialog.hide();

                }); 
            }
            if(fee!=''){
                if((total<1)||(fee>total)){
                    var $dialog = $('#dialog3');
                    $dialog.show();
                    $dialog.find('.weui_btn_dialog').on('click', function () {
                        $dialog.hide();

                    }); 
                }
                if((fee>=1)&&(fee<=total)){
                    $.ajax({
                         type: "POST",
                         url: "addFee.php",
                         data: {
                            username:username,
                            fee:fee,
                            action:'提现'
                         },
                         dataType: "json",
                         success: function(data){
                            
                         }
                    });
                    var $dialog = $('#dialog2');
                    $dialog.show();
                    $dialog.find('.weui_btn_dialog').on('click', function () {
                        $dialog.hide();
                        window.location.href='http://www.fangdan8.com/wxhb/index.php';

                    });  
                }

            }
            
        });

        */

    });

    
    </script>

<input type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>"/>
</body>
</html>