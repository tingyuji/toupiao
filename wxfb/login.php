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
              <li><a href="index.php">首页</a></li>
              <li class="active"><a href="login.php">登录</a></li>
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
            <span style="color:#F00;">新注册的会员请注意：</span>平台会定期清理一些没有充值，放过任务的账号，请知悉。</p>
      </div>
      <form action="loginform.php"  method="post">
      
        <div class="form-group">
        <label for="inputEmail" class="sr-only">账号</label>
        <input type="text" id="username" name="username" class="form-control">
        </div>

        <div class="form-group">
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
        <button class="btn btn-primary" type="submit">登陆</button>
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