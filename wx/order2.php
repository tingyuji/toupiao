<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>预约</title>
        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
    </head>
    <body ontouchstart>
        <div class="container js_container">

        </div>
      
<div class="page">
    <div class="hd">
        <h1 class="page_title">留年映画照相馆</h1>
    </div>
    <div class="bd">

        <div class="weui_cells_title">填写以下信息完成预约</div>
        <div class="weui_cells">
			<div class="weui_cell">
				<div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
				<div class="weui_cell_bd weui_cell_primary">
					<input id="name" class="weui_input" type="name" placeholder="请输入姓名"/>
				</div>
			</div>
			<div class="weui_cell">
				<div class="weui_cell_hd"><label class="weui_label">手机</label></div>
				<div class="weui_cell_bd weui_cell_primary">
					<input id="tel" class="weui_input" type="tel" placeholder="请输入手机号码"/>
				</div>
			</div>
      
        </div>

        <div class="weui_cells_title">列表项</div>
        <div class="weui_cells">
			<div class="weui_cell">
				<div class="weui_cell_hd"><label for="" class="weui_label">日期</label></div>
				<div class="weui_cell_bd weui_cell_primary">
					<input class="weui_input" type="date" placeholder="请选择日期" value=""/>
				</div>
			</div>
	

      
        </div>      
		
		
		<div class="weui_cells_tips"></div>
		<div class="weui_btn_area">
			<a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">下一步</a>
		</div>  



    </div>
</div>
        
<script src="./jquery-1.7.2.min.js"></script>
<script src="./example.js"></script>
<script type="text/javascript" src="js/purl.js"></script> 
<script type="text/javascript">

   

    $(document).ready(function(){
 
        
        $('#showTooltips').click(function(){
			window.location.href='order3.php';
        });
    });
    </script> 
</body>
</html>