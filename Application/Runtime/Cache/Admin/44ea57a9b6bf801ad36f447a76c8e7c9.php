<?php if (!defined('THINK_PATH')) exit();?><select name="coupons_val" id="coupons_val" onchange="changeVals(this)">
    <option value="-1">--请选择对用栏目--</option>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(empty($vo["child"])): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option>
            <?php else: ?>
            <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ch["id"]); ?>"><?php echo ($ch["title"]); ?>(<?php echo ($vo["title"]); ?>)</option><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
</select>