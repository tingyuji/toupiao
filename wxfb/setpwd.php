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
              <li><a href="index2.php">首页</a></li>
              <li><a href="pay.php">在线充值</a></li>
              <li><a href="wx.php">微信充值</a></li>
              <li><a href="add.php">MP任务</a></li>
              <li><a href="add4.php">扫码关注</a></li>
              <li><a href="add5.php">直投任务</a></li>
              <li><a href="add2.php">普通任务</a></li>
              <li><a href="add3.php">综合任务</a></li>
              <li><a href="task.php">任务列表</a></li>
              <li><a href="paylist.php">充值记录</a></li>
              <li><a href="balance.php">账户余额</a></li>
              <li class="active"><a href="setpwd.php">修改密码</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

      
    <div class="container">
      <div class="page-header">
          <p class="panel-title">密码修改已上线，为保证平台账户安全，烦请尽快修改平台密码</p>
      </div>
      <form action="setpwdform.php"  method="post">
      

        <div class="form-group">
        <label for="username" class="sr-only">账号</label>
        <input type="input" id="username" name="username" class="form-control" disabled="disabled" value="<?php echo $_SESSION['username'] ?>">
        </div>

        <div class="form-group">
        <label for="inputPassword" class="sr-only">老密码</label>
        <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
        <label for="newpassword" class="sr-only">新密码</label>
        <input type="password" id="newpassword" name="newpassword" class="form-control">
        </div>
        <div class="form-group">
        <button class="btn btn-primary" type="submit">确定</button>
        </div>
      </form>

      

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


  

</body>
</html>