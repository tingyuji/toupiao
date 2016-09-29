<?php
  session_start();
  unset($_SESSION['username']);
  session_destroy();

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
              <li class="active"><a href="index.php">首页</a></li>
              <li><a href="login.php">登录</a></li>
              <li><a href="contact.php">客服</a></li>
              <li><a href="note.php">通知</a></li>
              <li><a href="new.php">注册</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      
      <div class="page-header">
          <p class="panel-title">
            <span style="color:#F00;">注册任务</span>上线，欢迎各位放单，价格美丽，注册任务是平台继主推MP任务后希望打造的另一个特色，平台会在技术，定价等各方面进行倾斜
          </p>
          <p class="panel-title">--2016年07月09号</p>
      </div>


      <div class="page-header">
          <p class="panel-title"><span style="color:#F00;">任务追加功能</span>上线，从2016年7月11号开始发布的新任务后期都可以无限制追加</p>
          <p class="panel-title">--2016年07月11号</p>
      </div>      
    
      <div class="page-header">
          <p class="panel-title"><span style="color:#F00;">任务限速功能</span>上线，欢迎各位尝试</p>
          <p class="panel-title">--2016年07月13号</p>
      </div>  

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


  

</body>
</html>
