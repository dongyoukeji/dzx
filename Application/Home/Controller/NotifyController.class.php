<?php
/**
 * 测试(略)
 * @access public
 * @version 1.0
 * @author WangXin<znhljwx@163.com>
 */
namespace Home\Controller;
use Think\Controller;
class NotifyController extends PublicController {
	/**
	 * @todo 回调微信支付
	 */
	public function WeChatPay(){
		//引入WxPayPubHelper
        vendor('WxPayPubHelper.WxPayPubHelper');
        
        //使用通用通知接口
        $notify = new \Notify_pub();
        
        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if($xml == ''){
        	echo '请不要非法操作';exit();
        }
        
        $notify->saveData($xml);
        
        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
        	$notify->setReturnParameter("return_code","FAIL");//返回状态码
        	$notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
        	$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;
        
        $return_data = (array)$notify;
        $tree = (array)json_decode($return_data['data']['attach']);
        
        $this->OperationSql($tree['type'],$tree['id'],$tree['user_id']);
	}
	/**
	 * @todo 回调支付宝支付
	 */
	public function Alipay(){
		require_once("ThinkPHP/Library/Vendor/alipay/alipay.config.php");
		require_once("ThinkPHP/Library/Vendor/alipay/lib/alipay_notify.class.php");

		//计算得出通知验证结果
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		//验证成功
		if($verify_result) {
			//echo "success";//请不要修改或删除
			$data = json_decode($_GET['extra_common_param'],true);

			if(!M('order')->save(array(
				'id'=>$data['id'],
				'ordstatus'=>1,
				'payment_type'=>'alipay',
				'payment_trade_status'=>$_GET['trade_status'],
				'payment_notify_id'=>$_GET['notify_id'],
				'payment_notify_time'=>strtotime($_GET['notify_time']),
				'payment_buyer_email'=>$_GET['buyer_email'],
				'finishtime'=>time()
			))){
				p(M('order')->getlastsql());die;
				echo "fail";
			};
			$sms_info1 ="尊敬的".$data['username']."，你成功支付了订单号为".$data['ordid']."的账单".$data['ordfee']."元，现等待官方发货。";
			$_var = random(4,1);
			session('var',$_var);
			$_result = sendSMS($data['phone'],$_var,$sms_info1);

			echo <<<html
			<style type="text/css">
		.success{text-align:center; margin-top:30px;}
		*{margin:0;padding:0;}
		h1{font-size:130px;}
		.loader{font-size:20px; font-weight:bold; margin-top:5px;}
		#wait{color:red; font-size:24px; padding:0 2px;}
	</style>
	<div class="success">
		<h1>:)</h1>
		<h2>恭喜您支付成功，请保持手机通畅。后续的发货信息将以短信的形式通知您！</h2>
		<div class="loader">
			页面将在<span id="wait">3</span>后，进行跳转。
		</div>
	</div>
<script type="text/javascript">
	(function(){
	var wait = document.getElementById('wait');
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			parent.location.href = '/';
			clearInterval(interval);
		}
	}, 1000);
	})();
</script>
html;

			
		}else {
			//验证失败
			echo "fail";
		}
	}
}