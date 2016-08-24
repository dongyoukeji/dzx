<?php
namespace Wap\Controller;
use Think\Controller;
class QueryController extends BaseController {

    public function index($size=12){

        $this->display();
    }
    public function express($no='',$decode=1){
        if(!$decode){
            $no = getDeEncyptStr($no);
        }
        $order = M('order')->field('id,username,phone,shun_feng,ordid,ordtime,sums,wine,post_address,post_userinfo,post_goods_express,post_goods_time,post_wine_express,post_wine_time')->where(array('ordid'=>$no))->find();
        if(!empty($order)){
            if($order['isused']==2){
                $goods= M('article')->find($order['productid']);
                $goods['count']=1;
                $order['pro'][]=$goods;
            }else{
                foreach (explode('|',$order['sums']) as $k=>$v){
                    $temp = explode('_',$v);
                    if(strstr($v,'wine')){
                        $wine= M('article')->find($temp[1]);
                        $wine['count']=$temp[2];
                        $wine['price']=$temp[3];
                        $wine['totals']=$temp[3]*$temp[2];
                        $order['pro'][]=$wine;
                    }else if (strstr($v,'goods')){
                        $goods= M('article')->find($temp[1]);
                        $goods['count']=$temp[2];
                        $goods['price']=$temp[3];
                        $goods['totals']=$temp[3]*$temp[2];
                        $order['pro'][]=$goods;
                    }else{
                        $coupon= M('coupons')->where(array('coupon_cid'=>$temp[1]))->find();
                        $pr = M('article')->field('keywords,column_id,image,content,tprice,extend')->find($temp[1]);
                        $coupon['title']=$coupon['coupons_title'];
                        $coupon['count']=$temp[2];
                        $coupon['price']=$temp[3];
                        $coupon['totals']=$temp[3]*$temp[2];
                        $coupon=array_merge($coupon,$pr);
                        $order['pro'][]=$coupon;
                    }
                }
            }
        }
        //p($order);die;
        $this->vo=$order;
        // $data = $this->fetch();

         $this->display('details');

        //$this->ajaxReturn(array('status'=>1,'body'=>$data));
    }

    public function get_url($no=''){
        if(empty($no)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'输入订单号'));
        }
        $order = M('order')->field('id,username,phone,ordid,sums,wine,post_address,post_userinfo,post_goods_express,post_goods_time,post_wine_express,post_wine_time')->where(array('ordid'=>$no))->find();
        if(empty($order)){
            $this->ajaxReturn(array('status'=>0,'msg'=>'输入的订单号不正确'));
        }
        $this->ajaxReturn(array('status'=>1,'redirect'=>U('express?no='.$no)));
    }

}