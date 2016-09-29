<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">


    <title>留年映画照相馆-预约拍摄</title>

        <link rel="stylesheet" href="node_modules/weui/dist/style/weui.css"/>
        <link rel="stylesheet" href="css/example.css"/>
</head>
<body ontouchstart>
        <div class="container js_container">

    </div>
<div class="page" style="">
    <div class="hd">
        <h1 class="page_title">ActionSheet</h1>
    </div>
    <div class="bd spacing">
        <a href="javascript:;" class="weui_btn weui_btn_primary" id="showActionSheet">点击上拉ActionSheet</a>
    </div>
    <!--BEGIN actionSheet-->
    <div id="actionSheet_wrap">
        <div class="weui_mask_transition" id="mask"></div>
        <div class="weui_actionsheet" id="weui_actionsheet">
            <div class="weui_actionsheet_menu">
                <div class="weui_actionsheet_cell">示例菜单</div>
                <div class="weui_actionsheet_cell">示例菜单</div>
                <div class="weui_actionsheet_cell">示例菜单</div>
                <div class="weui_actionsheet_cell">示例菜单</div>
            </div>
            <div class="weui_actionsheet_action">
                <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
            </div>
        </div>
    </div>
    <!--END actionSheet-->
</div>


</body>
</html>
