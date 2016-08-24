<?php
/**
 * Created by PhpStorm.
 * User: 魏巍
 * Date: 2016/5/11
 * Time: 14:46
 */

/**
 * 处理订单函数
 * 更新订单状态，写入订单支付后返回的数据
 * @param $parameter
 */
function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['payment_trade_no']      =$parameter['trade_no'];
    $data['payment_trade_status']  =$parameter['trade_status'];
    $data['payment_notify_id']     =$parameter['notify_id'];
    $data['payment_notify_time']   =$parameter['notify_time'];
    $data['payment_buyer_email']   =$parameter['buyer_email'];
    $data['ordstatus']             =1;
    $ord=M('Orderlist');
    $ord->where('ordid='.$ordid)->save($data);
}

/**
 * 获取订单号
 * @return string
 */
function get_order_trade_no(){
    $order_number = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    return $order_number;
}

/**
 * 转换网址
 * @param $parameter
 * @return mixed
 */
function get_visit_url($parameter){
    $url = $parameter['url'];
    $orderId = $parameter['ordid'];
    $url = $url.'?sid=sid|'.$orderId.'|'.time();
    $appid = 'a78cc9e1b994ea1a4c90bb7cf9c21b3b';
    $url='http://ni2.org/api/create.json?url='.$url.'&user_key='.$appid;
    $res = json_decode(PostCurlSms('',$url),true);
     return str_replace('http://ni2.org','http://dzx.com/t',$res['url']);
}


/**
 * 获取产品介绍格式
 * @param $str
 * @return string
 */
function get_pro_details($str){
    $arr = explode('，',$str);
    $_result='';
    if(count($arr)<1){
        $_result=$str;
    }else{
        foreach ($arr as $v){
            $_result.="<p>$v</p>";
        }
    }
    return $_result;
}

function get_pro_right($str){
    $arr = explode('，',$str);
    return $arr[1];
}
function get_pro_left($str){
    $arr = explode('，',$str);
    return $arr[0];
}
function get_info_right($str){
    $arr = explode('|',$str);
    return $arr[1];
}
function get_info_left($str){
    $arr = explode('|',$str);
    return $arr[0];
}
function get_address_right($str){
    $arr = explode(' ',$str);
    return $arr[1];
}
function get_address_left($str){
    $arr = explode(' ',$str);
    return $arr[0];
}

function get_pro_details1($str){
    $arr = explode('，',$str);
    $_result='';
    if(count($arr)<1){
        $_result=$str;
    }else{
        foreach ($arr as $v){
            $_result.="<h2>$v</h2>";
        }
    }
    return $_result;
}

/**
 * 获取产品名称
 * @param $id
 * @return mixed
 */
function get_product_name($id){
    if(!is_numeric($id)){
       return '';
    }else{
        $article = M('article')->find($id);
        return $article['title'];
    }
}

/**
 * 隐匿中间
 * @param $user_name
 * @return string
 */
function substr_cut($user_name){
    $strlen     = mb_strlen($user_name, 'utf-8');
    $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
    $lastStr     = mb_substr($user_name, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}