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
<div class="admin_r_all" style="height: 555px;">
    <style type="text/css">
        .admin_bg_b li{
            line-height:70px;}
        .admin_bg_b li img{
            vertical-align:middle;}
    </style>
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="#" id="admin_bg_t_x">礼券列表</a>
            <a href="/Admin/Coupons/add">添加礼券</a>
            <div class="admin_bg_t_ss">
                <form action="">
                    <span>
                        <input name="coupons_title" type="text" value="<?php echo ($search["title"]); ?>" placeholder="卡券名称">
                        <input  type="submit" value="搜索">
                        <input  type="button" onclick="javascript:window.location.href='<?php echo U('index');?>'" value="全部">
                    </span>
                    <strong>
                        <select name="coupons_type1">
                            <option value="-1">筛选</option>
                            <option value="0" <?php if(($search["status1"]) == "0"): ?>selected<?php endif; ?>>未发放</option>
                            <option value="1" <?php if(($search["status1"]) == "1"): ?>selected<?php endif; ?>>已发放</option>
                            <option value="2" <?php if(($search["status1"]) == "2"): ?>selected<?php endif; ?>>以使用</option>
                        </select>
                    </strong>
                    <strong>
                        <select name="coupons_type">
                            <option value="-1">筛选</option>
                            <option value="0" <?php if(($search["status"]) == "0"): ?>selected<?php endif; ?>>实物卡券</option>
                            <option value="1" <?php if(($search["status"]) == "1"): ?>selected<?php endif; ?>>折扣卡券</option>
                            <option value="2" <?php if(($search["status"]) == "2"): ?>selected<?php endif; ?>>现金卡券</option>
                        </select>
                    </strong>
                </form>
            </div>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg4">礼券编号</li>
                <li class="admin_bg4">礼券名称</li>
                <li class="admin_bg4">礼券类型</li>
                <li class="admin_bg4">礼券状态</li>
                <li class="admin_bg4">使用信息</li>
                <li class="admin_bg1">操作</li>
            </ul>
            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                        <li class="admin_bg4">
                            <?php echo ($vo["coupons_no"]); ?>
                        </li>
                        <li class="admin_bg4">
                            <?php echo ($vo["coupons_title"]); ?>
                        </li>
                        <li class="admin_bg4">
                            <?php echo (get_coupons_type($vo["coupons_type"])); ?>
                        </li>
                        <li class="admin_bg4">
                            <?php if(($vo[""]) == "0"): endif; ?>
                        </li>
                        <li class="admin_bg4">
                            <?php if(($vo["coupons_status"]) == "0"): ?><b class="green">未发放</b><?php endif; ?>
                            <?php if(($vo["coupons_status"]) == "1"): ?><b class="red">已发放</b><?php endif; ?>
                            <?php if(($vo["coupons_status"]) == "2"): ?><b class="red">已使用</b><?php endif; ?>
                            <?php if(($vo["coupons_status"]) == "3"): ?><b class="red">已失效</b><?php endif; ?>
                        </li>
                        <li class="admin_bg4">
                            <?php echo (get_coupons_used($vo["id"])); ?>
                        </li>
                        <li class="admin_bg1">
                            <a href="/Admin/Coupons/see?id=<?php echo ($vo["id"]); ?>">查看</a>
                            <a href="/Admin/Coupons/del?id=<?php echo ($vo["id"]); ?>" class="confirm" data-role="您确定要删除文档吗？删除后将不能恢复。">删除</a>
                        </li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="admin_null"><?php echo ($page); ?></div>
                <?php else: ?>
                <div class="admin_null">暂无数据</div><?php endif; ?>
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