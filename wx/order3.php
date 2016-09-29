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


        <div class="weui_cells_title">列表项</div>
        <div class="weui_cells">
			
			<div class="weui_cell weui_cell_select weui_select_after">
				<div class="weui_cell_hd">
					项目
				</div>
				<div class="weui_cell_bd weui_cell_primary">
					<select class="weui_select" name="select2">
						<option value="1">项目1</option>
						<option value="2">项目2</option>
						<option value="3">项目2</option>
					</select>
				</div>
			</div>		

      
        </div>      

        <div class="weui_cells_title">备注</div>
        <div class="weui_cells">
			<div class="weui_cell">
				<div class="weui_cell_bd weui_cell_primary">
					<textarea class="weui_textarea" placeholder="请输入备注"></textarea>
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
			window.location.href='http://xiaomutong.com.cn/wx2/paysdk/example/pay.php';
        });
    });
    </script> 
</body>
</html>