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


    <link rel="stylesheet" href="bootstraptable/bootstrap-table.css">
 
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
              <li class="active"><a href="#">首页</a></li>
              <li><a href="pay.php">在线充值</a></li>
              <li><a href="wx.php">微信充值</a></li>
              <li><a href="add.php">MP任务</a></li>
              <li><a href="add4.php">扫码关注</a></li>
              <li><a href="add2.php">普通任务</a></li>
              <li><a href="add3.php">注册任务</a></li>
              <li><a href="task.php">任务列表</a></li>
              <li><a href="paylist.php">充值记录</a></li>
              <li><a href="balance.php">账户余额</a></li>
              <li><a href="setpwd.php">修改密码</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="page-header">
          <p class="panel-title">您的邀请码是：<?php echo $_SESSION['newcode'] ?></p>
      </div> 
      <div class="page-header">
          <p class="panel-title">
            <span style="color:#F00;">切换防御方案：<br></span>前几天由于受到攻击，平台不太稳定，现已切换新的防御方案，10000+重金砸下去了，大家近期看看效果
          </p>
          <p class="panel-title">--2016年07月28号</p>
      </div>
      

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstraptable/bootstrap-table.js"></script>
    <script src="bootstraptable/locale/bootstrap-table-zh-CN.js"></script>

  
<script type="text/javascript">
  
  $(document).ready(function(){
 
  });
</script>
</body>
</html>
