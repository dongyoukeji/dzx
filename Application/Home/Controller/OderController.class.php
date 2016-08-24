<?php
/**
 * 获取订单
 */
namespace Home\Controller;
use Think\Controller;

class OderController extends BaseController {

    public function get_goods(){

        $data = array(
            'post_userinfo'=>I('post.suser').'|'.I('post.sphone'),
            'post_address'=>I('post.city').'|'.I('post.street'),
            'shun_feng'=>$_POST['shunfeng_ems']?$_POST['shunfeng_ems']:0
        );

        $id = I('post.id');
        $map['ordcode']=array('like','%'.$id.'%');
        $order = M('order')->where($map)->find();

        if(empty($order['ordcode']) || !strstr($order['ordcode'],$id)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'你已经领取了，不能重复领取'));
        }

        $exp = explode(',',$order['ordcode']);
        $ids = '';
        foreach ($exp as $v){
            if($v!=$id){
                $ids.=','.$v;
            }else{
                $data['productid']=$v;
                $ids.=','."d_".$v;
            }
        }
        $time = time();
        $data['username']=I('post.suser');
        $data['phone']=I('post.sphone');
        $data['phone']=I('post.sphone');
        $data['ordtime']=$time;
        $data['finishtime']=$time;
        $data['ordbuynum']=1;
        $data['isused']=2;

        $t = M('order')->save(array(
            'id'=>$order['id'],
            'ordcode'=>$ids
        ));
        $tt = M('coupons')->save(array(
            'id'=>$id,
            'coupons_status'=>2,
            'coupons_use_date'=>time(),
            'coupons_use_user'=>$data['username']."|".$data['phone'],
            'coupons_use_order'=>$order['ordid']
        ));

        if(!$t || !$tt){
            $this->ajaxReturn(array('status'=>0,'msg'=>'领取失败请重试'));
        }
        $oid = M('order')->add($data);
//        $exp=array(
//            'orderid'=>$oid,
//            'order_no'=>$data['ordid'],
//            'express_create'=>time(),
//            'express_mall'=>I('post.suser').'|'.I('post.sphone'),
//            'express_geter'=>I('post.huser')."|".I('post.hphone').'|'.I('post.city').'|'.I('post.street')
//        );
//        M('express')->add($exp);
        $this->ajaxReturn(array('status'=>1,'msg'=>'领取成功请等待发货，请注意短信信息'));
    }

    /**
     * 支付
     */
    public function pay_for(){

        $list = $this->_get_price();
        $data = array(
            'username'=>I('post.suser'),
            'phone'=>I('post.sphone'),
            'post_address'=>I('post.city').' '.I('post.street'),
            'post_userinfo'=>I('post.huser')."|".I('post.hphone'),
            'shun_feng'=>$_POST['shunfeng_ems']?$_POST['shunfeng_ems']:0
        );

        //$data['price']=substr($price,1);
        $data['ordfee']=$list['totals'];
        $data['ordbuynum']=$list['muns'];
        $data['sums']=$list['details'];
        $data['ordtime']=time();
        $data['productid']=$list['productid'];
        $data['ordid']=get_order_trade_no();

        if(!$oid = M('order')->add($data)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'下单失败请重试'));
        }
        $_ids='';
        foreach ($list['update'] as $k => $j){
            if($k=='goods'){
               foreach ($j as $v){
                   M('article')->execute('UPDATE `think_article` SET `sum`=sum-'.$v['sum'].'  WHERE `id`='.$v['id']);
                   $_id = M('coupons')->execute('UPDATE `think_coupons` SET `coupons_status`=3 WHERE `coupon_cid`='.$v['id'].' ORDER BY `coupons_no` DESC LIMIT '.$v['sum']);
               }
            }else if($k=='coupon'){
                foreach ($j as $v) {
                    $_id = M('article')->execute('UPDATE `think_article` SET `sum`=sum-' . $v['sum'] . '  WHERE `id`=' . $v['id']);
                    $coupons = M('coupons')->where(array('coupon_cid' => $v['id'], 'coupons_status' => 0))->limit($v['sum'])->select();
                    foreach ($coupons as $kk) {
                        $_ids .= ',' . $kk['id'];
                        M('coupons')->save(array(
                            'id' => $kk['id'],
                            'coupons_status' => 1,
                            'coupon_send' => time()
                        ));
                    }
                }
                M('order')->save(array(
                    'id'=>$oid,
                    'ordcode'=>substr($_ids,1)
                ));
            }else{
                foreach ($j as $v){
                    M('article')->execute('UPDATE `think_article` SET `sum`=sum-'.$v['sum'].'  WHERE `id`='.$v['id']);
                }
            }
        }
        //新增物流
//        $exp=array(
//            'orderid'=>$oid,
//            'order_no'=>$data['ordid'],
//            'express_create'=>time(),
//            'express_mall'=>I('post.suser').'|'.I('post.sphone'),
//            'express_geter'=>I('post.huser')."|".I('post.hphone').'|'.I('post.city').'|'.I('post.street')
//        );
//
//        if(!M('express')->add($exp)){
//            $this->ajaxReturn(array('status'=>0,'msg'=>'下单失败请重试'));
//        };


        session('short_cart',null);
        $this->ajaxReturn(array('status'=>1,'msg'=>'恭喜你下单成功','order_id'=>$oid,'redirect'=>U('doAlyPay?order_id='.$oid)));
    }

    /**
     * 获取价格信息
     * @return array
     */
    private function _get_price(){
        $nums=I('post.num');
        $mass=I('post.mass');
        $price = I('post.price');
        $id= I('post.id');

        $box = $this->_get_box();
        $city = explode('-',$_POST['city']);
        $ac = $this->get_price($city[0]);
        $box_price = $this->_get_box_price();

        $total = 0;
        $kg = 0;
        $details='';
        $sums=0;
        $productid ='';
        $update=array();
        foreach ($id as $k => $v){
            for ($i=0;$i<count($v);$i++){
                $sums += $n = $nums[$k][$i];
                $p = $price[$k][$i];
                $total+=$p*$n;
                if($k=='goods'){
                    $m = $mass[$k][$i];
                    $kg += $m*$n;
                    $update[$k][$i]=array(
                        'id'=>$v[$i],
                        'sum'=>$n,
                        'c'=>$nums['coupon'][$i],
                        'price'=>$p,
                    );
                }else if($k=='coupon'){
                    $update[$k][$i]=array(
                        'id'=>$v[$i],
                        'sum'=>$n,
                        'c'=>$nums['goods'][$i],
                        'price'=>$p,
                    );
                }else{
                    $ff='';
                    $boxid ='';
                    foreach ($box as $j => $jj) {
                        $temp = explode('_',$jj);
                        $boxid .= ",".$jj;
                        if($temp[1]==$v[$i]){
                            $ff .= ",".$jj;
                        }
                        
                    }
                    $update[$k][$i]=array(
                        'id'=>$v[$i],
                        'sum'=>$n,
                        'c'=>0,
                        'price'=>$p,
                        'box'=>substr($ff,1)
                    );
                }
                //类型_ID_数量_价格
                $details .= "|".$k."_".$v[$i]."_".$n."_".$p;
                $productid .=",".$k."_".$v[$i];

            }
        }
        
        $list['details']=substr($details,1);
        $list['mas']=$this->_get_mass_price($ac['price'],$ac['overweight'],$kg);
        $list['productid']=substr($productid,1);
        $list['boxid']=substr($boxid,1);
        $list['muns']=$sums;
        $list['total']=$total;
        $list['box_price']=$box_price;
        $list['totals']=$total+$list['mas']+$box_price;
        $list['update']=$update;
        p($list);die;
        return $list;
    }
    /**
     * [_get_box_price 获取包装价格]
     * @return [type] [description]
     */
    private function _get_box_price(){
        $box =I('post.box_num');
        $isbox = I('post.box_num_selected');

        $_result=0;
        foreach ($isbox as $k => $v) {

            if($v[0]==1){
                
                $tmp = explode('_', $k);
                $pi = M('article')->field('id,price,tprice')->find($tmp[2]);
                $sums = $box[$k][0];
                $_result += $pi['tprice']*$sums;
            }
        }

        return $_result;
    }

    /**
     * [_get_box 获取包装盒信息]
     * @return [type] [description]
     */
    private function _get_box(){
        $box =I('post.box_num');
        $isbox = I('post.box_num_selected');

        $_result=array();
        foreach ($isbox as $k => $v) {
            if($v[0]==1){
                $tmp = explode('_', $k);
                $pi = M('article')->field('id,price,tprice')->find($tmp[2]);
                $sums = $box[$k][0];
                //类型_产品ID_盒子id_数量_价格
                $_result[] = $k."_".$box[$k][0]."_".$pi['tprice']*$sums;
            }
        }
        return $_result;
    }


    /**
     * 获取地区价格
     * @param $n
     * @return array
     */
    private function get_price($n){
        $data = file_get_contents('./Data/SFExpress.js');
        $data = json_decode(trim_all($data),true);
        $price = array();
        foreach ($data as $v){
            if(strstr($n,$v['title'])){
                foreach ($v['price'] as $j){
                    if($j['date']==2){
                        $price =  $j;
                        break;
                    }
                }
                break;
            }
        }
        return $price;
    }

    /**
     * 获取邮费
     * @param $p
     * @param $p1
     * @param $h
     * @return mixed
     */
    private function _get_mass_price($p,$p1,$h){
        if($h==0){
            return 0;
        }
        if($h==1){
            return $p;
        }else{
            return $p+($h-1)*$p1;
        }
    }
    public function cancel($id){
        if(!M('order')->save(array(
            'id'=>$id,
            'ordstatus'=>2
        ))){
            $this->ajaxReturn(array('status'=>0,'msg'=>'取消订单成功'));
        }
        $this->ajaxReturn(array('status'=>1,'msg'=>'取消订单成功','redirect'=>U('index/index')));
    }

    public function details() {
        $sid = explode('|',I('get.sid'));
        $order = M('order')->field('username,ordtime,finishtime,productid,ordtitle,ordbuynum,ordprice,ordfee,ordstatus,post_address,post_express')->where('ordid='.$sid[1])->find();

        if(empty($order)){
            //exit('订单号不存在');
            $this->error=1;
        }
        if(time()-$sid[2]>604800){
            //exit('订单号已失效');
            $this->error=2;
        }
        //查找物流
    }

    /**
     * 支付宝支付
     */
    public function doAlyPay($order_id){
        $order = M('order')->field('id,ordfee,ordid,username,phone,ordtime')->find($order_id);

        require_once("ThinkPHP/Library/Vendor/alipay/alipay.config.php");
        require_once("ThinkPHP/Library/Vendor/alipay/lib/alipay_submit.class.php");
        /**************************请求参数**************************/
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order['ordid'];
        //订单名称，必填
        $subject = '阳澄湖大闸蟹专卖店';
        //付款金额，必填
        $total_fee = $order['ordfee'];
        //商品描述，可空
        $body = '';
        /************************************************************/
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service"       	=> "create_direct_pay_by_user",
            "partner"       	=> '2088021699723760',
            "seller_id"  		=> '2088021699723760',
            "payment_type"		=> "1",
            #"notify_url"		=> "http://dzx.com/Notify/Alipay",
            "return_url"		=> "http://dzx.com/Notify/Alipay",
            "anti_phishing_key"	=> "",
            "exter_invoke_ip"	=> "",
            "out_trade_no"		=> $out_trade_no,
            "subject"			=> $subject,
            "total_fee"			=> 0.01,
            "body"				=> "$body",
            "_input_charset"	=> trim(strtolower(strtolower('utf-8'))),
            //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
            "extra_common_param"=> json_encode($order)
        );
        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
        
    }

    /**
     * 微信支付
     */
    public function doWechatPay($order_id){
        $order = M('order')->find($order_id);
        $total_fee = $order['ordfee'] * 100;
        $out_trade_no = $order['ordid'];
        //引入WxPayPubHelper
        vendor('WxPayPubHelper.WxPayPubHelper');

        //使用统一支付接口
        $unifiedOrder = new \UnifiedOrder_pub();

        //设置必填参数
        $unifiedOrder->setParameter("body","阳澄湖大闸蟹专卖店");//商品描述
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee","$total_fee");//总金额
        $unifiedOrder->setParameter("notify_url", 'http://www.pinkan.com/Notify/WeChatPay');//通知地址
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型


        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        $unifiedOrder->setParameter("attach",'');//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //         $unifiedOrder->setParameter("goods_tag","");//商品标记
        //         $unifiedOrder->setParameter("openid","19405");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID
        //获取统一支付接口结果
        $unifiedOrderResult = $unifiedOrder->getResult();
        p($unifiedOrderResult);
    }

    /**
     * 生成二维码
     * @param $url
     * @param bool $fileName
     * @param string $level
     * @param string $size
     * @return mixed
     */
    public function qrcode($url,$fileName=false,$level='L',$size='4'){
        Vendor('QrCode.phpqrcode');
        if($fileName != false){
            $path = "Uploads/qrcode/";
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
            $fileName = $path.$fileName;
        }

        $level =intval($level) ;//容错级别
        $size = intval($size);//生成图片大小

        $object = new \QRcode();
        return $object->png($url, $fileName, $level, $size, 2);
    }

    /**
     * @return array
     */
    private function _get_order(){
        $num= I('post.num');
        $mass= I('post.mass');
        $price= I('post.price');
        $id= I('post.id');
        $_result =array();
        //酒水
        if($num['wine']) {
            $wine['sum']=$num['wine'];
            $wine['mass']=$mass['wine'];
            $wine['price']=$price['wine'];
            $wine['totals']=$num['wine']*$price['wine'];
            $wine['id']=$id['wine']['id'];
            $wine['order_type']='wine';
            $_result[]=$wine;
        }
        //实物(礼盒)
        if($num['goods']){
            $goods['sum']=$num['goods'];
            $goods['mass']=$mass['goods'];
            $goods['price']=$price['goods'];
            $goods['id']=$id['goods']['id'];
            if(empty(I('post.shunfeng_ems'))){
                //顺丰快递附加费
                $goods['ems']=22+($num['goods']*$mass['goods']-1)*14;
            }else{
                $goods['ems']=0;
            }
            $goods['totals']=$num['goods']*$price['goods']+ $goods['ems'];
            $goods['order_type']='goods';
            $_result[]=$goods;
        }
        if($num['coupon']){
            //礼券
            $coupon['sum']=$num['coupon'];
            $coupon['mass']=$mass['coupon'];
            $coupon['price']=$price['coupon'];
            $coupon['totals']=$num['coupon']*$price['coupon'];
            $coupon['id']=$id['coupon']['id'];
            $coupon['order_type']='coupon';
            $_result[]=$coupon;
        }
        return $_result;
    }
}