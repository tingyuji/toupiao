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



    <div class="container">
      <div class="page-header">
      <p class="panel-title">
      <button id="images" class="btn" type="button">去审图</button>
      <button id="update" class="btn" type="button">已审图</button>        

      </p>

      </div> 

     
      <div>
        <table id="table"></table>                                        
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
    var $table=$('#table');
    $table.bootstrapTable({
        url:'getAllData36.php',
        striped: true,
        pagination: true,
        columns: [{
            field: 'state',
            radio: true,

        }, {
            field: 'id',
            title: 'id'
        }, {
            field: 'title',
            title: '标题'
        }, {
            field: 'num',
            title: '总数'
        }, {
            field: 'complete',
            title: '已接'
        }, {
            field: 'done',
            title: '已完成'
        }, {                          
            field: 'status',
            title: '状态'
        }, { 
            field: 'image',
            title: '审图'
        }, {                                    
            field: 'createTime',
            title: '发布时间'
        }]
    });

    $table.on('check.bs.table uncheck.bs.table ' +
              'check-all.bs.table uncheck-all.bs.table', function () {
        

          // save your data, here just save the current page
          selections = getIdSelections();
          //console.log(selections);
          // push or splice the selections if you want to save all data selections
    });
    function getIdSelections() {
        var id='';
        $.map($table.bootstrapTable('getSelections'), function (row) {
            id=row.id;
            
        });
        return id;
    }    
    $('#images').click(function(){
      var id = getIdSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }      
      window.location.href='http://www.fangdan8.com/wxfb/images2.php?pid='+id;
    }); 

    $('#image').click(function(){

        var id = getIdSelections();
        if(id==''){
          alert('请先选择任务'); 
          return;
        }
        //alert(id);
        $.ajax({
          type:'post',        
          url:'updateImage.php',
          data:{
            id:id
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