<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/5/23
 * Time: 10:42
 */

namespace Wap\Controller;
use Think\Controller;

class GetgoodsController extends BaseController{
    private $homepage='';
    public function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
    }
    public function index(){
        $this->display();
    }
    public function details($no=''){
        if(!$no){
            $this->display("Common:404");
        }
        $coupons = D('goods')->where(array('coupons_no'=>$no))->find();

        if($coupons['coupons_status']!=1){
            $this->ajaxReturn(array('status'=>0,'msg'=>'输入的兑换券不正确或已使用'));
        }
        $this->nums = $nums = 1;
        $kg  =$coupons['mass'];
        $this->nums = $nums = 1;
        if($kg<1){
            $tal = 0;
        }else{
            $tal = 12+($kg-1)*2;
        }
        $this->mass_totals= $mass_totals = $tal;
        $this->totals =  $nums*$coupons['tprice']+$tal;
        $this->vo=$coupons;
        $this->display();
    }


    //注意 city方法 本身是 protected 方法
    protected function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码

       if(strstr($_SERVER['REQUEST_URI'],'/t')){
          $url = str_replace('/t','http://ni2.org',$_SERVER['REQUEST_URI']);
           header('location:'.$url);
       }
        $this->assign('home',$this->homepage);
        $this->display("Common:404");
    }

}