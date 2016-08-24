<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="product_info">
        <strong class="product_img"><img src="<?php echo ($vo["image"]); ?>"></strong>
        <div class="product_price">
            <strong>
                <em class="triangle-left"></em>
                <i>抢鲜价</i>
                <b><font>￥<?php echo ($vo["tprice"]); ?></font>元</b>
                <small class="triangle-topleft"></small>
            </strong>
            <span>
                <i>市场价：<?php echo ($vo["price"]); ?>元</i>
                <b><?php echo ($vo["title"]); ?></b>
                <u>产品规格</u>
                <?php echo (get_pro_details($vo["description"])); ?>
                <!--<p>4只公蟹2.5-3两</p>-->
                <!--<p>4只母蟹2.0-2.5两</p>-->
            </span>
            <img src="/Public/Home/images/zhengpin.fw.png">
            <a href="<?php echo U('product/details?id='.$vo['id']);?>" class="raisecar">查看详情</a>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>