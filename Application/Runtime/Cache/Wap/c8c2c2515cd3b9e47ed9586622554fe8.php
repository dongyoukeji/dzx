<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 商品 -->
    <a href="<?php echo U('product/details?id='.$vo['id'].'&t=c');?>" class="pro_coupon">
        <span class="coupon_left">
            <strong>
                <h4><?php echo ($vo["coupons_title"]); ?></h4>
                <p class="yellow_col"><?php echo (get_pro_left($vo['pro']['description'])); ?></p>
                <p class="yellow_col"><?php echo (get_pro_right($vo['pro']['description'])); ?></p>
            </strong>
        </span>
        <span class="coupon_rigt">
            <strong>
                <h4 class="white_col">礼品券</h4>
                <b class="yellow_col">￥<?php echo ($vo['pro']['tprice']); ?></b>
            </strong>
        </span>
    </a><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="clear"></div>
<input type="hidden" id="p<?php echo ($p); ?>_num" value="<?php echo ($pagination); ?>">
<script type="text/javascript">
    IsPage();
</script>