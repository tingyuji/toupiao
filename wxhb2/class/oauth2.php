<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');
require_once 'class/fee.class.php';
class Wxapi {
    private $app_id = 'wxf26b83f0a766a32b';
    private $app_secret = 'cafd55d65bbba76243e7de3dc46bdeb4';
    private $app_mchid = '1332158101';

    public $total_amount=100;

    function __construct(){
    //do sth here....
    }
    /**
     * 微信支付
     * 
     * @param string $openid 用户openid
     */
    public function pay($re_openid,$db=null)
    {

        $feeClass=new feeClass();
        $total=$feeClass->getCount3($re_openid);
        if($total==0){
            $this->total_amount=0;
            
        }
        if($total!=0){
            $items=$feeClass->getAll3($re_openid);
            $item=$items[0];
            $id=$item['id'];
            $fee=$item['fee'];
            $this->total_amount=$fee*100;
            
            include_once('WxHongBaoHelper.php');

            $commonUtil = new CommonUtil();
            $wxHongBaoHelper = new WxHongBaoHelper();

            $wxHongBaoHelper->setParameter("mch_appid", $this->app_id);
            $wxHongBaoHelper->setParameter("mchid", $this->app_mchid);//商户号
            $wxHongBaoHelper->setParameter("nonce_str", $this->great_rand());//随机字符串，丌长于 32 位
            $wxHongBaoHelper->setParameter("partner_trade_no", $this->app_mchid.date('YmdHis').rand(1000, 9999));//订单号
            $wxHongBaoHelper->setParameter("openid", $re_openid);//相对于医脉互通的openid
            $wxHongBaoHelper->setParameter("check_name", 'NO_CHECK');//备注信息
            $wxHongBaoHelper->setParameter("re_user_name", '小时光');//备注信息

            $wxHongBaoHelper->setParameter("amount", $this->total_amount);//付款金额，单位分
            $wxHongBaoHelper->setParameter("desc", '佣金发放');//备注信息
            $wxHongBaoHelper->setParameter("spbill_create_ip", '120.76.129.239');//调用接口的机器 Ip 地址

                       


            /*
            $wxHongBaoHelper->setParameter("nonce_str", $this->great_rand());//随机字符串，丌长于 32 位
            $wxHongBaoHelper->setParameter("mch_billno", $this->app_mchid.date('YmdHis').rand(1000, 9999));//订单号
            $wxHongBaoHelper->setParameter("mch_id", $this->app_mchid);//商户号
            $wxHongBaoHelper->setParameter("wxappid", $this->app_id);
            $wxHongBaoHelper->setParameter("nick_name", '红包');//提供方名称
            $wxHongBaoHelper->setParameter("send_name", '红包');//红包发送者名称
            $wxHongBaoHelper->setParameter("re_openid", $re_openid);//相对于医脉互通的openid
            $wxHongBaoHelper->setParameter("total_amount", $this->total_amount);//付款金额，单位分
            $wxHongBaoHelper->setParameter("min_value", 100);//最小红包金额，单位分
            $wxHongBaoHelper->setParameter("max_value", 100);//最大红包金额，单位分
            $wxHongBaoHelper->setParameter("total_num", 1);//红包収放总人数
            $wxHongBaoHelper->setParameter("wishing", '恭喜发财');//红包祝福诧
            $wxHongBaoHelper->setParameter("client_ip", '120.76.128.150');//调用接口的机器 Ip 地址
            $wxHongBaoHelper->setParameter("act_name", '红包活动');//活劢名称
            $wxHongBaoHelper->setParameter("remark", '快来抢！');//备注信息
            */


            $postXml = $wxHongBaoHelper->create_hongbao_xml();
            
            //红包
            //$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

            //付款
            $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

            $responseXml = $wxHongBaoHelper->curl_post_ssl($url, $postXml);
            $responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);
            
            $return_code=$responseObj->return_code;
            $result_code=$responseObj->result_code;

            if($result_code=='SUCCESS'){
                echo '提现成功';
                echo '<br>';
                $partner_trade_no=$responseObj->partner_trade_no;
                $feeClass->update2($id,$partner_trade_no);

                $url='http://www.fangdan8.com/wxtp2/message.php';
                header("Location: http://www.fangdan8.com/wxtp2/message.php");
                exit;
            }
            if($result_code=='FAIL'){
                $return_msg=$responseObj->return_msg;
                echo $return_msg;
                echo '<br>';
                exit;
            }
            if($return_code!='SUCCESS'){
                $return_msg=$responseObj->return_msg;
                echo $return_msg;
                echo '<br>';
                echo '提现失败，请留下截图，联系小时光';
                echo '<br>';   
            }

            return $responseObj->return_code;

            return;
        }

    }
    /**
     * 获取微信授权链接
     * 
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function get_authorize_url($redirect_uri = '', $state = '')
    {
        $redirect_uri = urlencode($redirect_uri);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";  
        echo "<script language='javascript' type='text/javascript'>";  
        echo "window.location.href='$url'";  
        echo "</script>";       
    }       
    
    /**
     * 获取授权token
     * 
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function get_access_token($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);
        if(!empty($token_data[0]))
        {
            return json_decode($token_data[0], TRUE);
        }
        
        return FALSE;
    }   

    /**
     * 获取授权后的微信用户信息
     * 
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info($access_token = '', $open_id = '')
    {
        if($access_token && $open_id)
        {
			$access_url = "https://api.weixin.qq.com/sns/auth?access_token={$access_token}&openid={$open_id}";
			$access_data = $this->http($access_url);
			$access_info = json_decode($access_data[0], TRUE);
			if($access_info['errmsg']!='ok'){
				exit('页面过期');
			}
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->http($info_url);  		
            if(!empty($info_data[0]))
            {
                return json_decode($info_data[0], TRUE);
            }
        }
        
        return FALSE;
    }   	
    /**
     * Http方法
     * 
     */ 
    public function http($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $output = curl_exec($ch);//输出内容
        curl_close($ch);
        return array($output);
    }   

    /**
     * 生成随机数
     * 
     */     
    public function great_rand(){
        $str = '1234567890abcdefghijklmnopqrstuvwxyz';
        for($i=0;$i<30;$i++){
            $j=rand(0,35);
            $t1 .= $str[$j];
        }
        return $t1;    
    }
}
?>