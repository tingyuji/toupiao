<?php
session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
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
              <li class="active"><a href="#">任务限速</a></li>
    
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      
      <div class="page-header">
          <p class="panel-title">任务限速，只能输入数字，比如一秒一票请输入数字1，两秒一票请输入数字2。</p>
      </div>
      <div>
         <p class="text-info ">
           请按上述提示输入数字：
          </p>
          <div class="form-group">
          <input id="num" type="text" class="form-control" name="orderid">
          </div>
          <div class="form-group">
          <input id="ok" class="btn btn-info" type="button" value="确认" name="OK">
          </div>



                                              
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
    
    var url = $.url(); 
    var pid=url.param('pid'); 
    $('#ok').click(function(){
      var num=$('#num').val();
      $.ajax({
          type:'post',        
          url:'limitform.php',
          data:{
            pid:pid,
            num:num
          },
          async:false,
          success:function(data){    
            alert('处理成功');                   
            window.location.reload();
          }
      }); 
    });

  });
</script> 

</body>
</html>
