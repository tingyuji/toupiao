<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");

require_once 'class/done.class.php';
require_once 'class/task.class.php';
require_once 'class/orders.class.php';
require_once 'class/abandon.class.php';
require_once 'class/mapping.class.php';
require_once 'class/worker.class.php';
require_once 'class/alipay.class.php';
require_once 'class/income.class.php';
require_once 'class/profit.class.php';


$wechatObj = new wechatCallbackapiTest("wx6b67564e8a86d086","528cb1cf8a6a350a68f0af34e1a81fa7");

//$wechatObj->valid();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest{
    private $appId;
    private $appSecret;
 
    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }    
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    $taskClass=new taskClass();
    $ordersClass=new ordersClass();
    $abandonClass=new abandonClass();
    $mappingClass=new mappingClass();
    $workerClass=new workerClass();

    $alipayClass = new alipayClass();
    $incomeClass = new incomeClass();
    $profitClass = new profitClass();

    $doneClass=new doneClass();
      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $msgType=strtolower($postObj->MsgType);
                $event=strtolower($postObj->Event);   


                $time = time();

                $textTpl = "<xml>
              							<ToUserName><![CDATA[%s]]></ToUserName>
              							<FromUserName><![CDATA[%s]]></FromUserName>
              							<CreateTime>%s</CreateTime>
              							<MsgType><![CDATA[%s]]></MsgType>
              							<Content><![CDATA[%s]]></Content>
              							<FuncFlag>0</FuncFlag>
              							</xml>";  
                $newsTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                $newsTpl2="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[小番茄登陆提示]]></Title>
                          <Description><![CDATA[本系统一次登陆永久有效]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                      

                switch($msgType){
                   case "event":
                          switch (strtolower($postObj->Event)){
                            case "subscribe":
                                    $msgType2 = "text";
                                    $contentStr="欢迎请你的大驾光临，请从下方菜单选择您需要的服务吧";
                                    //$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr; 
                                    break;
                            case "unsubscribe":
                                    $mappingClass->del($fromUsername);
                                    break;
                            case "click":

                                    $key=strtolower($postObj->EventKey);
                                    
                                    
                                    switch ($key) {
                                        case 'key1':
                                            $total=$mappingClass->getCount2($fromUsername);
                                            //$total=0;
                                            if($total==0){
                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                              
                                            }
                                            if($total!=0){

                                              $items=$mappingClass->getAll2($fromUsername);
                                              $item=$items[0];
                                              $status=$item['status'];
                                              $step=$item['step'];
                                              $username=$item['username'];
                                              if($step<3){
                                                $url='http://www.vxtoupiao.com/wx/login.php';
                                                $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                                $PicUrl ='http://www.vxtoupiao.com/wx/logo/logo.png';
                                                $contentStr.=$url2;
                                                $msgType2 = "news";
                                                $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                                              }
                                              if($step==3){
                                                $total=$ordersClass->getCount6($username);
                                                if($total>0){
                                                  $items=$ordersClass->getAll6($username);
                                                  $item=$items[0];
                                                  $pid=$item['pid'];
                                                  $title=$item['title'];
                                                  $url=$item['url'];
                                                  $intro='您已经接受了【'.$title.'】投票任务，请完成后再接新任务哦。
    如果无法完成该任务或者任务目标网页出错，可以回复【放弃】跳过该任务。';

                                                  
                                                  $items=$taskClass->getAll2($pid);
                                                  $item=$items[0];
                                                  $title=$item['title'];
                                                  $url=$item['url'];
                                                  $price2=$item['price2'];
                                                  $type=$item['type'];
                                                  $img1=$item['img1'];
                                                  $img2=$item['img2'];
                                                  $imgUrl='http://www.vxtoupiao.com/wxfb/'.$img1;

                                                  $PicUrl =$imgUrl;
                                                  $title='[已参与][未完成]'.$title;

                                                  if($type=='扫码关注'){
                                                      $url='http://www.vxtoupiao.com/wx/scan.php?img='.$img2;
                                                  }

                                                  $msgType2 = "news";
                                                  $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType2,$title,$intro, $PicUrl,$url);  

                                                }
                                                if($total==0){

                                                  
                                                  
                                                  $total=$taskClass->getCount3($username);
                                                  if($total==0){
                                                    $contentStr='任务都被抢光啦~亲稍等一下，马上就有任务喽。';
                                                    $msgType = "text";
                                                    //$contentStr="如果有多张截图请继续发送，如果已经发送完毕，请回复【完成】。";
                                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                    echo $resultStr; 
                                                  }
                                                  if($total!=0){
                                                    $items=$taskClass->getAll6($username);
                                                    $item=$items[0];
                                                    $pid=$item['id'];
                                                    $title=$item['title'];
                                                    $url=$item['url'];
                                                    $price2=$item['price2'];
                                                    $times=$item['times'];

                                                    $message="佣金：".$item['price2']."\n";
                                                    $message.="描述：".$item['intro'];
                                                    
                                                    $type=$item['type'];
                                                    $img1=$item['img1'];
                                                    $img2=$item['img2'];
                                                    $imgUrl='http://www.vxtoupiao.com/wxfb/'.$img1;


                                                    $url=$url;
                                                    if($type=='扫码关注'){
                                                      $url='http://www.vxtoupiao.com/wx/scan.php?img='.$img2;
                                                    }
                                                    //$message=$message.$url;
                                                    
                                                    //$url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxc3e3f3ee1d734a11&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                                    $PicUrl =$imgUrl;
                                                    
                                                    $orderid=$ordersClass->makeorderid();
                                                    $memo='';
                                                    $imgfile='';
                                                    $source='wx';
                                                    $ordersClass->add($username,$orderid,$pid,$title,$imgfile,$memo,$source);

                                                    $taskClass->update4($pid,$times);

                                                    
                                              
                                                    $fee=$price2;
                                                    $orderNo=$orderid;
                                                    $action='平台收益';
                                                    $remarks='';
                                                    $alipayClass->add($username,$fee,$orderNo,$action,$remarks);


                                                    $fee=$price2;
                                                    $action='平台收益';
                                                    $incomeClass->add($username,$fee,$orderid,$action);


                                                    $title='[已参与]'.$title;
                                                    $msgType = "news";
                                                    $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,$title,$message, $PicUrl,$url);   
                                                    echo $resultStr;                                               
                                                  }

                                                } 
                                              }
                                             
                                            }


                                            




                                            break; 
                                        case 'key2':
                                            $total=$mappingClass->getCount2($fromUsername);
                                            //$total=0;
                                            if($total==0){

                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                            }
                                            if($total!=0){

                                              $items=$mappingClass->getAll2($fromUsername);
                                              $item=$items[0];
                                              $status=$item['status'];
                                              $step=$item['step'];
                                              $username=$item['username'];
                                              if($step<3){
                                                $url='http://www.vxtoupiao.com/wx/login.php';
                                                $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                                $PicUrl ='';
                                                $contentStr.=$url2;
                                                $msgType2 = "news";
                                                $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                                              }
                                              if($step==3){

                                                $total=$ordersClass->getCount6($username);
                                                if($total>0){
                                                  $items=$ordersClass->getAll6($username);
                                                  $item=$items[0];
                                                  $pid=$item['pid'];
                                                  $title=$item['title'];
                                                 
                                                  $intro ="您当前正在进行任务[".$title."]。\n";
                                                  $intro.="如果未完成任务或无法完成请回复【放弃】\n";
                                                  $intro.="如果已经完成该任务，请提交任务截图：\n";
                                                  $intro.="**提交的截图务必是完成任务的证据图，否则您的账户将会被冻结。**";
                                                  

                                                  
                                                  $items=$taskClass->getAll2($pid);
                                                  $item=$items[0];
                                                  $title=$item['title'];
                                                  $url=$item['url'];
                                                  $price2=$item['price2'];
                                                  $type=$item['type'];
                                                  
                                                  $img1=$item['img1'];
                                                  $img2=$item['img2'];
                                                  $imgUrl='http://www.vxtoupiao.com/wxfb/'.$img1;


                                                  $PicUrl =$imgUrl;

                                                  if($type=='扫码关注'){
                                                      $url='http://www.vxtoupiao.com/wx/scan.php?img='.$img2;
                                                  }

                                                  //$intro=$intro.$url;

                                                  $title='[已参与][未完成]'.$title;

                                                  $msgType2 = "news";
                                                  $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType2,$title,$intro, $PicUrl,$url);  
                                                  echo $resultStr;
                                                }
                                                if($total==0){

                                                  $contentStr="没有需要提交的任务。"."\n";
                                                  $contentStr.="可能是因为您还未接过任何任务，或者您接受的任务已经过期超时。";
                                                  
                                                  $msgType='text';
                                                
                                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                  echo $resultStr; 

                                                } 
                                                //$msgType = "text";

                                                //$contentStr ="您当前正在进行任务【投73号汤晓燕，其他每组随意选一个】"."\n";
                                                //$contentStr.="如果未完成任务或无法完成请回复【放弃】"."\n";
                                                //$contentStr.="如果已经完成该任务，请提交任务截图："."\n";
                                                //$contentStr.="**提交的截图务必是完成任务的证据图，否则您的账户将会被冻结。**";
                                                //$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                //echo $resultStr; 
                                              }      
                                            }

                              
                                            break;
                                       
                                        case 'login':


                                            $url='http://www.vxtoupiao.com/wx/login.php';
                                            $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                            $PicUrl ='';
                                            $contentStr.=$url2;
                                            $msgType2 = "news";
                                            $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                            break;


                                          break;
                                                                                 

                                        default:
                                            # code...
                                            break;
                                    }
                                    if($msgType2=='text'){
                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    }
                                    //if($msgType2=='news'){
                                    //  $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                    //}
                                    //$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    

                                    echo $resultStr;
                                    break;                            
                            default:
                                    $msgType2 = "text";
                                  
                                    $contentStr=$fromUsername;
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr;                             
                           }

                   break;
                   case "text":

                            $keyword=$keyword;
                            switch ($keyword) {
                                case '完成':
                              $total=$mappingClass->getCount2($fromUsername);
                              //$total=0;
                              if($total==0){

                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                              }
                              if($total!=0){

                                $items=$mappingClass->getAll2($fromUsername);
                                $item=$items[0];
                                $status=$item['status'];
                                $step=$item['step'];
                                $username=$item['username'];
                                if($step<3){
                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                                }
                                if($step==3){
                                  $total=$ordersClass->getCount7($username);
                                  if($total==0){
                                    $msgType = "text";
                                    $message='您当前没有正在进行中的任务';
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr; 
                                  }
                                  if($total!=0){

                                    $items=$ordersClass->getAll7($username);
                                    $item=$items[0];  
                                    $pid=$item['pid'];
                                    $title=$item['title'];
                                    $orderid=$item['orderid'];

                                    $type='已完成';
                                    $doneClass->add($username,$pid,$title,$type);

                                    $status='已完成';
                                    $ordersClass->update3($orderid,$status);
                                    $msgType='text';
                                    $message='完成任务截图提交，管理员审核通过后您会获得该任务的奖励。';
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr; 
                                  }
                                }
                              }

                                  break;
                                case '放弃':

                                $total=$mappingClass->getCount2($fromUsername);
                                //$total=0;
                                if($total==0){

                                    $url='http://www.vxtoupiao.com/wx/login.php';
                                    $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                    $PicUrl ='';
                                    $contentStr.=$url2;
                                    $msgType2 = "news";
                                    $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                }
                                if($total!=0){

                                  $items=$mappingClass->getAll2($fromUsername);
                                  $item=$items[0];
                                  $status=$item['status'];
                                  $step=$item['step'];
                                  $username=$item['username'];
                                  if($step<3){
                                      $url='http://www.vxtoupiao.com/wx/login.php';
                                      $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                      $PicUrl ='';
                                      $contentStr.=$url2;
                                      $msgType2 = "news";
                                      $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                                  }
                                  if($step==3){
                                    $total=$ordersClass->getCount6($username);
                                    if($total==0){
                                      $msgType = "text";
                                      $message='您当前没有正在进行中的任务';
                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                      echo $resultStr; 
                                    }
                                    if($total!=0){

                                      $items=$ordersClass->getAll6($username);
                                      $item=$items[0];  
                                      $pid=$item['pid'];
                                      $title=$item['title'];
                                      $orderid=$item['orderid'];                                


                                      $items=$taskClass->getAll2($pid);
                                      $item=$items[0];
                                      $id=$item['id'];
                                      $title=$item['title'];
                                      $url=$item['url'];
                                      $price2=$item['price2'];
                                      $img1=$item['img1'];
                                      $intro=$item['intro'];
                                      $imgUrl='http://www.vxtoupiao.com/wxfb/'.$img1;



                                      $status='已放弃';
                                      $ordersClass->update3($orderid,$status);

                                      $abandonClass->add($username,$pid,$title);
                                      $type='已放弃';
                                      $doneClass->add($username,$pid,$title,$type);

                                      $PicUrl =$imgUrl;
                                      $title='[已参与][放弃]'.$title;
                                      $msgType = "news";
                                      $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,$title,$intro, $PicUrl,$url);  
                                      //$contentStr=$title;
                                      //$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                      echo $resultStr; 
                                    }
                                  }
                                }

                                  break;
                                default:
                                  $total=$mappingClass->getCount2($fromUsername);
                                  //$total=0;
                                  if($total==0){

                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                  }
                                  if($total!=0){
                                    $items=$mappingClass->getAll2($fromUsername);
                                    $item=$items[0];
                                    $step=$item['step'];

                                    if($step<3){
                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);
                                    }
                                    if($step==3){
                                          $mappingClass->update2($fromUsername,$keyword);
                                          
                                          
                                          $items=$mappingClass->getAll2($fromUsername);
                                          $item=$items[0];
                                          $username=$item['username'];
                                          $contentStr="您已经登录，现在可以使用任务小番茄的功能了。";


                                          $msgType='text';
                                          //$contentStr=$total;
                                          //$contentStr='完成任务截图提交，管理员审核通过后您会获得该任务的奖励。';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                          echo $resultStr; 
                                    }



                                  }

                                                          
                               }
                                               
      
                   break;
                   case "image":
                        $total=$mappingClass->getCount2($fromUsername);
                        //$total=0;
                        if($total==0){

                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr); 
                        }
                        if($total!=0){

                          $items=$mappingClass->getAll2($fromUsername);
                          $item=$items[0];
                          $status=$item['status'];
                          $step=$item['step'];
                          $username=$item['username'];
                          if($step<3){
                                              $url='http://www.vxtoupiao.com/wx/login.php';
                                              $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6b67564e8a86d086&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                              $PicUrl ='';
                                              $contentStr.=$url2;
                                              $msgType2 = "news";
                                              $resultStr = sprintf($newsTpl2, $fromUsername, $toUsername, $time, $msgType2, $PicUrl,$contentStr);

                          }
                          if($step==3){
                            $total=$ordersClass->getCount6($username);
                            if($total==0){
                              $msgType = "text";
                              $message='您当前没有正在进行中的任务';
                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                              echo $resultStr; 
                            }
                            if($total!=0){

                              $items=$ordersClass->getAll6($username);
                              $item=$items[0];  
                              $pid=$item['pid'];
                              $orderid=$item['orderid'];

                              $media_id=$postObj->MediaId; 

                              $access_token=$this->getAccessToken();
                              $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
                              
                              //if (!file_exists("./Uploads")) {
                              //    mkdir("./Uploads", 0777, true);
                              //}
                              //$targetName = './Uploads/'.date('YmdHis').rand(1000,9999).'.jpg';
                              
                              $time=date('YmdHis');
                              $p=md5($time);
                              $p1 = substr($p,0,1);
                              $p2 = substr($p,1,1);
                              $p3 = substr($p,2,1);

                              $folder='Uploads'.'/'.$p1.'/'.$p2.'/'.$p3.'/';
                              if (!file_exists($folder)) {
                                  mkdir($folder, 0777, true);
                              }
                              $targetName = $folder.$time.rand(1000,9999).'.jpg';

                              $ch = curl_init($url); // 初始化
                              $fp = fopen($targetName, 'wb'); // 打开写入
                              curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
                              curl_setopt($ch, CURLOPT_HEADER, 0);
                              curl_exec($ch);
                              curl_close($ch);
                              fclose($fp);

                              $ordersClass->update4($orderid,$targetName);
                              
                              $msgType = "text";
                              $message="如果已经发送完毕，请回复[完成]。";
                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                              echo $resultStr; 
                            }

                          }
                        }

       
                   break;

                }                                        
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                  //$contentStr=$_SESSION['status'];
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }

    public function sendGetData($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
    public function sendPostData($url,$curlPost){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
    public function send_template_message($template){
             $token=$this->getAccessToken();
             $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;        
             $res=$this->sendPostData($url,$template);
             return  json_decode($res,true);

    }
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

      public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$url='http://tel.xsdcm.cn/sample.php';

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
          "appId"     => $this->appId,
          "nonceStr"  => $nonceStr,
          "timestamp" => $timestamp,
          "url"       => $url,
          "signature" => $signature,
          "rawString" => $string
        );
        return $signPackage; 
      }

      private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
          $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
      }

      private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("jsapi_ticket.php"));
        if ($data->expire_time < time()) {
          $accessToken = $this->getAccessToken();
          // 如果是企业号用以下 URL 获取 ticket
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
          $res = json_decode($this->httpGet($url));
          $ticket = $res->ticket;
          if ($ticket) {
            $data->expire_time = time() + 7000;
            $data->jsapi_ticket = $ticket;
            $this->set_php_file("jsapi_ticket.php", json_encode($data));
          }
        } else {
          $ticket = $data->jsapi_ticket;
        }

        return $ticket;
      }

      private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
          // 如果是企业号用以下URL获取access_token
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
          $res = json_decode($this->httpGet($url));
          $access_token = $res->access_token;
          if ($access_token) {
            $data->expire_time = time() + 7000;
            $data->access_token = $access_token;
            $this->set_php_file("access_token.php", json_encode($data));
          }
        } else {
          $access_token = $data->access_token;
        }
        return $access_token;
      }

      private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
      }

      private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
      }
      private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
      }    
}

?>
