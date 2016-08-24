<?php

/**
 * Created by PhpStorm.
 * User: 魏巍
 * Date: 2016/7/1
 * Time: 10:14
 */
namespace Service;

class Aliypay{
    private $config;
    /**
     * Aliypay constructor.
     * @param $partner
     * @param $account
     * @param $key
     * @param $return_url
     * @param $notify_url
     */
    public function __construct ($partner,$account,$key,$return_url,$notify_url){
        $this->config = array(
            'alipay_partner'=>$partner,
            'alipay_account'=>$account,
            'alipay_key'=>$key,
            'return_url' => $return_url,
            'notify_url' => $notify_url,
        );
    }

    /**
     * 获取支付链接
     * @param $form     array 支付表单
     * @return string   支付链接
     */
    public function get_payment_code($form){
        $link = $form['pay_type'] == 'ALIPAY' ? $this->alipay_link($form) : $this->bank_link($form);
        return $link;
    }

    /**
     * 银联接连
     * @param $form   array  表单数据
     * @return string   支付链接
     */
    private function bank_link($form){
        $payment_notice = array(
            'money'=>$form['money'],
            'deal_name'=>$form['deal_name'],
            'bank_id'=>$form['pay_type'],
            'notice_sn'=>$form['notice_sn'],
            'extend_param'=>$form['extend_param']
        );
        $money = round($payment_notice['money'],2);
        $payment_info = $this->config;
        $subject = $payment_notice['deal_name'];

        $data_return_url = $payment_info['return_url'];
        $data_notify_url = $payment_info['notify_url'];
        $service = 'create_direct_pay_by_user';
        /* 银行类型 */
        $bank_type = $payment_notice['bank_id'];

        $parameter = array(
            'service'           => $service,
            'partner'           => $payment_info['alipay_partner'],
            //'partner'           => ALIPAY_ID,
            '_input_charset'    => 'utf-8',
            'notify_url'        => $data_notify_url,
            'return_url'        => $data_return_url,
            /* 业务参数 */
            'subject'           => $subject,
            'out_trade_no'      => $payment_notice['notice_sn'],
            'price'             => $money,
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            'extend_param'    => $payment_notice['extend_param'],
            /* 买卖双方信息 */
            'seller_id'      => $payment_info['alipay_account'],
            'defaultbank'    =>    $bank_type,
            'payment'    =>    'bankPay'
        );

        $parameter = $this->argSort($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val){
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment_info['alipay_key'];
        $sign_md5 = md5($sign);

        $payLinks = '<form target="_blank" action="https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.$sign_md5.'&sign_type=MD5" id="jumplink" method="post">正在连接支付接口...</form>';
        $payLinks.='<script type="text/javascript">document.getElementById("jumplink").submit();</script>';
        return $payLinks;
    }

    /**
     * 支付宝链接
     * @param $form     array  表单数据
     * @return string   支付链接
     */
    private function alipay_link($form){
        $payment_notice = array(
            'money'=>$form['money'],
            'deal_name'=>$form['deal_name'],
            'bank_id'=>$form['pay_type'],
            'notice_sn'=>$form['notice_sn'],
            'extend_param'=>$form['extend_param']
        );
        $money = round($payment_notice['money'],2);
        $payment_info = $this->config;
        $subject = $payment_notice['deal_name'];

        $data_return_url = $payment_info['return_url'];
        $data_notify_url = $payment_info['notify_url'];

        $parameter = array(
            'service'           => 'create_direct_pay_by_user',
            'partner'           => $payment_info['alipay_partner'],
            '_input_charset'    => 'utf-8',
            'notify_url'        => $data_notify_url,
            'return_url'        => $data_return_url,
            /* 业务参数 */
            'subject'           => $subject,
            'out_trade_no'      => $payment_notice['notice_sn'],
            'price'             => $money,
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            'extend_param'        => $payment_info['extend_param'],
            /* 买卖双方信息 */
            'seller_id'      => $payment_info['alipay_account']
        );
        //p($form);
        //p($parameter);die;
        // print_r($parameter);exit;
        $parameter = $this->argSort($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment_info['alipay_key'];
        $sign_md5 = md5($sign);

        $payLinks = '<form action="https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.$sign_md5.'&sign_type=MD5" id="jumplink" method="post">正在连接支付接口...</form>';
        $payLinks.='<script type="text/javascript">document.getElementById("jumplink").submit();</script>';

        return $payLinks;
    }

    /**
     * 退款接口
     * @param $form
     * @return string
     */
    public function refund_fastpay($form){
        $payment_notice = array(
            "batch_no"	=> $form['batch_no'],                            //批次号。11-32位，退款日期+流水號
            "batch_num"	=>  $form['batch_num'],                     //退款笔数。單筆退款集中的交易總數
            "refund_date"	=> $form['batch_date'],                    //退款当天日期。格式：yyyy-MM-dd hh:mm:ss
            "detail_data"	=> $this->made_detail($form),               //退款详细数据。單筆退款交易數據集，包含退交易，腿分潤和退收費信息，最多100條
        );

        $payment_info = $this->config;
        $data_return_url = $payment_info['refund_return_url'];
        $data_notify_url = $payment_info['refund_notify_url'];

        $parameter = array(
            'service'           => 'refund_fastpay_by_platform_nopwd',  //refund_fastpay_by_platform_nopwd 無密碼退款；refund_fastpay_by_platform_pwd 有密碼退款
            'partner'           => $payment_info['alipay_partner'],
            '_input_charset'    => 'utf-8',
            'return_type'        =>'HTML',
            'notify_url'        => $data_notify_url,
            'return_url'        => $data_return_url,
            /* 退款业务参数 */
            'detail_data'       => $payment_notice['detail_data'],
            'batch_no'          => $payment_notice['batch_no'],
            'refund_date'          => $payment_notice['refund_date'],
            'batch_num'          => $payment_notice['batch_num'],
            /* 卖双方信息 */
            'seller_id'      => $payment_info['alipay_account']
        );
        // print_r($parameter);exit;
        $parameter = $this->argSort($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment_info['alipay_key'];
        $sign_md5 = md5($sign);
        $action ="https://www.alipay.com/cooperate/gateway.do?$param&sign=$sign_md5&sign_type=MD5";

        $payLinks = '<form action="'.$action.'" id="jumplink" method="post">正在连接退款接口...</form>';
        $payLinks.='<script type="text/javascript">document.getElementById("jumplink").submit();</script>';

        return $payLinks;
    }

    /**
     * 组织退款详情
     * @param $form
     * @return string
     */
    private function made_detail($form){
        $result = '';
        foreach ($form as $k =>$v){
            if(empty($v)){
                continue;
            }
            if(strpos($k,"refund_")!==false){
                $result.=$v.'^';
            }
        }
        //$result = substr($result,0,-1)."#";
        return $result;
    }

    /**
     * 结果
     * @param $request
     * @return array
     */
    public function notify($request){
        $return_res = array(
            'info'=>'',
            'status'=>false,
        );
        $request = $this->argSort($request);
        /* 检查数字签名是否正确 */
        $isSign = $this->getSignVeryfy($request);
        if (!$isSign){//签名验证失败
            $return_res['info'] = '签名验证失败';
            return $return_res;
        }
        if ($request['trade_status'] == 'TRADE_SUCCESS' || $request['trade_status'] == 'TRADE_FINISHED' || $request['trade_status'] == 'WAIT_SELLER_SEND_GOODS' || $request['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS'){
            $return_res['status'] = true;
        }
        return $return_res;
    }

    /**
     * 获取返回时的签名验证结果
     * @param $para_temp
     * @return bool
     */
    private function getSignVeryfy($para_temp) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $isSgin = false;
        $isSgin = $this->md5Verify($prestr, $para_temp['sign'], $this->config['alipay_key']);
        return $isSgin;
    }

    /**
     * 验证签名
     * @param $prestr
     * @param $sign
     * @param $key
     * @return bool
     */
    private function md5Verify($prestr, $sign, $key) {
        $prestr = $prestr . $key;
        $mysgin = md5($prestr);
        if($mysgin == $sign) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para
     * @return string
     */
    private function createLinkstring($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".$val."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);
        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para
     * @return array
     */
    private function paraFilter($para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {
            if($key == "sign" || $key == "sign_type" || $val == "")
                continue;
            else
                $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序
     * @param $para
     * @return mixed
     */
    private function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }
}