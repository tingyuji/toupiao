<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>样图</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
        <div class="page">
            <div class="weui_msg">
                <div class="weui_text_area">
                    <img id="img1" style="width:100%;text-align:center;border:1px solid #FF00FF;" src="" alt="" />
                </div>
                <div class="weui_opr_area">
                    <p class="weui_btn_area">
                        <a href="javascript:;" id="ok" class="weui_btn weui_btn_primary"></a>
                      
                    </p>
                </div>
               
            </div>
        </div>


    <script src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/purl.js"></script>
    <script type="text/javascript">
      
    $(document).ready(function(){
        var base='http://www.fangdan8.com/wxfb/';
        var url = $.url(); 
        var id=url.param('id')||181;
        $.ajax({
            type:'post',        
            url:'getAll.php',
            data:{
              id:id
            },
            dataType:'json',
            async:false,
            success:function(data){    
              var item=data[0];
              //console.log(data);
              var type=item['type'];
              var img1=item['img1'];
              var img2=item['img2'];
              var url=item['url'];

              $('#type').val(type);
              $('#img2').val(img2);
              $('#url').val(url);

              $('#img1').attr('src',base+img1);
              if(type=='扫码关注'){
                $('#ok').html('去扫码');
              }
              if(type=='普通任务'){
                $('#ok').html('去做任务');
              }

            }
        }); 
        $('#ok').click(function(){
            var type=$('#type').val();
            var img2=$('#img2').val();
            var url=$('#url').val();
            if(type=='普通任务'){
                window.location.href=url;
            }
            if(type=='扫码关注'){
                window.location.href='scan.php?img='+img2;
            }
        });

        
        
    });

    
    </script>

<input type="hidden" id="type" value=""/>
<input type="hidden" id="img2" value=""/>
<input type="hidden" id="url" value=""/>

</body>
</html>