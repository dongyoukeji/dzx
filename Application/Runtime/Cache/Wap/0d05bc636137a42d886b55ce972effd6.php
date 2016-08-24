<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 商品 -->
    <a href="<?php echo U('product/details?id='.$vo['id']);?>" class="pro_hairy">
        <span class="hairy_left">
            <img src="<?php echo ($vo["image"]); ?>">
        </span>
        <span class="hairy_right">
            <h2><i></i><span>抢鲜价</span><font>￥<?php echo ($vo["tprice"]); ?></font><em></em></h2>
            <u>市场价：￥<?php echo ($vo["price"]); ?></u>
            <b><?php echo (sub_str($vo["title"],0,9)); ?></b>
            <u class="pro_guige">产品规格</u>
              <?php echo (get_pro_details($vo["description"])); ?>
        </span>
    </a><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="clear"></div>
<input type="hidden" id="p<?php echo ($p); ?>_num" value="<?php echo ($pagination); ?>">
<script type="text/javascript">
    IsPage();
</script>