<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2016/8/11
 * Time: 10:16
 */

namespace Wap\Model;

use Think\Model\ViewModel;

class GoodsModel extends ViewModel{
    public $viewFields = array(
        'Coupons'=>array('id'=>'coupons_id','coupons_title','coupons_no','coupons_type','coupons_status','coupon_content','coupon_cid'),
        'Article'=>array('title','description','image','content','price','mass','tprice','sum','_on'=>'Coupons.coupon_cid=Article.id'),
    );
}