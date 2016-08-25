<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>阳澄湖大螃蟹后台</title>
<meta content="关键词" name="Keywords">
<meta content="描述" name="Description">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/admin_all.css">
<link type="text/css" href="/Public/Plug/layer-v2.2/layer/skin/layer.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/Admin/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="/Public/Plug/layer-v2.2/layer/layer.js"></script>
<script src="/Public/Plug/jquery.validate/jquery.validate.js" type="text/javascript"></script>
<link href="/Public/Plug/jquery.validate/jquery.validate.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_all">
	<div class="admin_l">
    <a></a>
    <span>
        <i>1024</i>
        <strong>506</strong>
        <i>30</i>
    </span>
    <div>
        <i>BASIC DATA</i>
        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["contr_name"]) != "Admin"): ?><a href="<?php echo ($vo["url"]); ?>" <?php if((CONTROLLER_NAME) == $vo["contr_name"]): ?>id="admin_dhxz"<?php endif; ?>><?php echo ($vo["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <?php if($gid != 10): if( $gid != 11): ?><i>ARTICLES DATA</i>
                <?php if(is_array($nav_column)): $i = 0; $__LIST__ = $nav_column;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><a href="/Admin/Article/index?cid=<?php echo ($cl["id"]); ?>" <?php if(($cl["id"]) == $_GET['cid']): ?>id="admin_dhxz"<?php endif; ?> <?php if(($inIt) == $cl["id"]): ?>id="admin_dhxz"<?php endif; ?> ><?php echo ($cl["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>
        <i>EXECUTION DATA</i>
        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["contr_name"]) == "Admin"): ?><a href="<?php echo ($vo["url"]); ?>" <?php if((CONTROLLER_NAME) == $vo["contr_name"]): ?>id="admin_dhxz"<?php endif; ?>><?php echo ($vo["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <!--<?php if(($gid) == "-1"): ?><a href="/Admin/Admin" <?php if((CONTROLLER_NAME) == "Admin"): ?>id="admin_dhxz"<?php endif; ?>>账号管理</a><?php endif; ?>-->
    </div>
</div>
	<div class="admin_r">
		 <span>
        	<i>总公司后台</i>
        	<a href="<?php echo U('public/logout');?>">退出登录</a>
            <strong><?php echo ($time); ?></strong>
        </span>
<script src="/Public/Plug/jquery.validate/my.rules.js" type="text/javascript"></script>
<div class="admin_r_all" style="height: 477px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a>ID:xone</a>
            <a href="#" id="admin_bg_t_x">客服管理</a>
        </div>
        <div class="admin_bg_fb">
            <span>
                <em>订单号</em>
               <label><?php echo ($vo1["ordid"]); ?></label>
            </span>
            <span>
                <em>支付信息</em>
                <label><?php echo ($vo1["username"]); ?>|<?php echo ($vo1["phone"]); ?>|<?php echo (date('Y-m-d h:s',$vo1["ordtime"])); ?></label>
            </span>

            <?php if($vo1['isused']!=2): ?><span>
                    <em>支付账号</em>
                    <label><?php echo ($vo1["payment_buyer_email"]); ?>|<?php echo ($vo1["ordfee"]); ?>|<?php echo (date('Y-m-d h:s',$vo1["finishtime"])); ?></label>
                </span><?php endif; ?>
            <span>
                <em>收货信息</em>
                <label><?php echo ($vo1["post_userinfo"]); ?>|<?php echo ($vo1["post_address"]); ?></label>
            </span>
            <span>
                <em>产品信息</em>
                <?php if(is_array($vo1["pro"])): $i = 0; $__LIST__ = $vo1["pro"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pr): $mod = ($i % 2 );++$i;?><div>
                        <?php if(count($pr['box']) == 0): ?>商品：<?php echo ($pr["title"]); ?>|数量：<?php echo ($pr["count"]); ?>
                            <?php else: ?>
                            商品：<?php echo ($pr["title"]); ?>|数量：<?php echo ($pr["count"]); ?> 商品：<?php echo ($pr['box']['title']); ?>|数量：<?php echo ($pr['box']['sum']); endif; ?>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </span>
            <span>
                <em>产品单号</em>
                <?php if(!empty($vo1["post_goods_express"])): ?>产品单号：<?php echo ($vo1["post_goods_express"]); endif; ?> <?php if(!empty($vo1["post_wine_express"])): ?>酒水单号：<?php echo ($vo1["post_wine_express"]); endif; ?>
                <?php if($vo1["post_goods_express"] == '' and $vo1["post_wine_express"] == ''): ?>/<?php endif; ?>
            </span>
            <span>
                <em>邮费支付</em>
                <label><?php if(($shun_feng) == "1"): ?>到付<?php else: ?>已付<?php endif; ?></label>
            </span>
            <div class="admin_bg_b2 admin_bg_b3">
                <input type="button" onclick="history.go(-1)" value="返回">
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<script>
    function wh_all(){
        var a=$(window).width();
        var b=$('.admin_l').width();
        $('.admin_r').css('width',a-b)
        $('.admin_l').css('height',$(window).height());
        $('.admin_r_all').css('height',$(window).height()-100);
    }
    $(function(){
        wh_all();
        $(window).resize(function(){
            wh_all();
        });
        $('.btn-all').click(function () {
            $url = $(this).attr('data-role');
            window.location.href=$url;
        });
        /**
         * confirm提示框
         */
        $('.confirm').click(function (e) {
            e.preventDefault();
            $msg =$(this).attr('data-role');
            $href=$(this).attr('href');
            layer.confirm($msg, {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.get($href,function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 2});
                    }else {
                        reload(data.msg,2);
                    }
                });
            });
        });
        /**
         * tips 提示
         */
        $('.tips').click(function () {
            layer.tips($(this).attr('data-role'), $(this));
        });

        $('.check-status').click(function (e) {
            e.preventDefault();
            $href = $(this).attr('href');
            $.get($href,function (data) {
                if(data.status==1){
                    window.location.reload();
                }
            });
        });
    });
    /**
     * 跳转页面
     * @param url       跳转地址
     * @param msg       提示信息
     * @param sec       跳转时间:0不跳转
     */
    function redirect(url,msg,sec) {
        layer.msg(msg+","+sec+"秒后页面跳转",{icon:1,time:sec*1000});
        setTimeout(function () {
            if(sec>0){
                window.location.href=url;
            }
        },sec*1000);
    }
    /**
     * 重新加载页面
     * @param msg
     * @param sec
     */
    function reload(msg,sec) {
        layer.msg(msg+"，"+sec+"秒后页面重新加载",{icon:1,time:sec*1000});
        setTimeout(function () {
            if(sec>0){
                window.location.reload();
            }
        },sec*1000);
    }
</script>
</body>
</html>