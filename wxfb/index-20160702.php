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
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      
      <div>
          主打MP任务是平台未来发展的一个尝试方向，希望各位合伙人给于支持和资源倾斜。
      </div>
      <div style="width:100%;height:100%;padding-top:10px;">
        求各位大爷，给一分打赏，攒够一元，给大家发红包，<a target="blank" href="http://www.fangdan8.com/wxwx/native.php">赏你了</a>
      </div>
    
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


  

</body>
</html>
