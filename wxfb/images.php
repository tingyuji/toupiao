<?php
session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}

$pid = isset($_GET['pid']) ? $_GET['pid'] : '';
require_once 'class/task.class.php';
$taskClass=new taskClass();

$items=$taskClass->getAll3($pid);
$username2=$items[0]['username'];

if($username!=$username2){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>赚米吧</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">


 
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">赚米吧</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="task.php">返回</a></li>
              <li class="active"><a href="#">任务截图</a></li>
    
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <div class="page-header">
          <p class="panel-title">由于平台佣金发放规则为第二天11点开始发放前一日佣金，所以请在这个时间之前完成投诉</p>
      </div>

      <div class="page-header">
          <p class="panel-title" id="message"></p>
      </div>
      <div id="imgs">
        <!--
        <ul class="thumbnails" id="thumbnails">
          <li class="span4" style="width:200px;height:300px;">
            <a href="#" class="thumbnail">
              <img style="width:200px;height:300px;" src="pc1.jpg" alt="">
            </a>
          </li>
          <li class="span4" style="width:200px;height:300px;">
            <a href="#" class="thumbnail">
              <img style="width:200px;height:300px;" src="pc1.jpg" alt="">
            </a>
          </li>
        </ul>
        -->


                                              
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>


 <script type="text/javascript">
  
  $(document).ready(function(){
    var base='http://www.fangdan8.com/wx/';
    var base='http://7xsomq.com2.z0.glb.clouddn.com/';

    var url = $.url(); 
    var pid=url.param('pid'); 
    $.ajax({
      type: 'POST',
      url: 'getAllData23.php',
      data: {
        pid:pid
      },
      dataType: 'json',
      success: function(data){
        var total=data.total;
        var total2=data.total2;
        $('#message').html('当前任务'+total+'人已参与，已上传图片'+total2);
        var rows=data.rows;
        $('#imgs').html('');
        for(var i=0;i<total2;i++){
            var row=rows[i];
            var id=row['id'];
            var orderid=row['orderid'];
            var status=row['status'];
            var imgs=row['imgs'];
            var imgArr=imgs.split(",");

           

            if(status=='投诉'){
                var html='<ul id="'+orderid+'" class="thumbnails" style="border: 1px solid #F00;padding:2px;">';
            }else{
                var html='<ul id="'+orderid+'" class="thumbnails" style="border-bottom: 1px solid #eeeeee;padding:2px;">';
            }
            
            for (var j=0;j<imgArr.length;j++) {
                //if(j<2){
                    var img=imgArr[j];

                    html+='<li style="width:200px;height:350px;">';
                    html+='<a href="javascript:void(0)" class="thumbnail">';
                    html+='<img style="width:200px;height:300px;" src='+base+img+' alt="">';
                                      
                    html+='</a>';  
                    html+='</li>'; 
                    
                //}

            }
                    html+='<li style="width:200px;height:350px;">';
                    html+='<a href="javascript:void(0)" class="thumbnail">';
                    html+='<img style="width:200px;height:250px;" src="" alt="">';
                    
                    html+='<p>'+orderid+'</p>';

                    if(status=='投诉'){
                        html+='<p><button value="'+orderid+'" class="btn" type="button">已投诉</button></p>';
                    }else{
                        //html+='<p><button value="'+orderid+'" class="btn btn-success" type="button">封号</button>';
                        html+='<button value="'+orderid+'" class="btn btn-info" type="button">投诉</button></p>';
                       
                    }
                    
                    
                    html+='</a>';  
                    html+='</li>'; 
            html+='</ul>';
            $('#imgs').append(html); 
            
        }
        //投诉处理
        $('.btn-info').click(function(){
            var orderid = $(this).attr("value");
            $.ajax({
              type: 'POST',
              url: 'update16.php',
              data: {
                orderid:orderid
              },
              dataType: 'json',
              success: function(data){
                 
              }
            });
            $(this).removeClass("btn-info").html('已投诉');
            $('#'+orderid).css('border','1px solid red');
        });

        //封号处理
        $('.btn-success').click(function(){
            var orderid = $(this).attr("value");
            $.ajax({
              type: 'POST',
              //url: 'update18.php',
              data: {
                orderid:orderid
              },
              dataType: 'json',
              success: function(data){
                 
              }
            });
            $(this).removeClass("btn-info").html('已封号');
            $('.btn-info').removeClass("btn-info").html('已投诉');
            $('#'+orderid).css('border','1px solid red');
        });

      }
    });


  });
</script> 

</body>
</html>
