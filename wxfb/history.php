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
              <li><a href="list.php">返回</a></li>
              <li class="active"><a href="#">任务明细</a></li>
    
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      
      <div class="page-header">
          <p class="panel-title" id="message">任务明细，方便用户核对自己的任务消费记录，终止的任务，佣金返现在12小时后进行</p>
      </div>
      <div>
        <table id="table"></table>                                        
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script type="text/javascript" src="js/purl.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstraptable/bootstrap-table.js"></script>
    <script src="bootstraptable/locale/bootstrap-table-zh-CN.js"></script>

 <script type="text/javascript">
  
  $(document).ready(function(){

    var url = $.url(); 
    var pid=url.param('pid'); 
    var $table=$('#table');
    $table.bootstrapTable({
        url:'getAllData16.php?pid='+pid,
        striped: true,
        method: 'post',
        dataType:'json',
        queryParams:{
          pid:pid
        },
        pagination: true,
        columns: [{
            field: 'createTime',
            title: '时间'
        }, {
            field: 'action',
            title: '行为'
        }, {
            field: 'fee',
            title: '消费'
        }]
    });


  });
</script> 

</body>
</html>