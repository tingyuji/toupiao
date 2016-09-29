<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>已放弃的任务</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstraptable/src/bootstrap-table.css">


        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstraptable/src/bootstrap-table.js"></script>
        <script src="bootstraptable/src/locale/bootstrap-table-zh-CN.js"></script>
    </head>
    <body ontouchstart>
    <div>
        <table id="table"></table>

    </div>
      




        
    <script type="text/javascript">
      
    $(document).ready(function(){
        $('#table').bootstrapTable({
            url: 'getAllData5.php',
            columns: [{
                field: 'pid',
                title: '任务编号'
            }, {
                field: 'title',
                title: '任务名称'
            }, {
                field: 'price2',
                title: '佣金'
            }]
        });
        
    });
    
    </script>

<input type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>"/>
</body>
</html>