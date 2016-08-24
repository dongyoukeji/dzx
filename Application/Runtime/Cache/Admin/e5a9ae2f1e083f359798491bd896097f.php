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
<div class="admin_r_all" style="height: 477px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <?php if(!empty($child)): if(count($child) > 1): if(is_array($child)): $i = 0; $__LIST__ = $child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?><a href="/Admin/Article/index?cid=<?php echo ($ch["id"]); ?>" <?php if(($ch["id"]) == "Think.get.cid"): ?>id="admin_bg_t_x"<?php endif; ?> <?php if(($inIt) == $ch["id"]): ?>id="admin_bg_t_x"<?php endif; ?> ><?php echo ($ch["title"]); ?>列表</a><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <a href="/Admin/Article/index?cid=<?php echo ($child[0]['id']); ?>" id="admin_bg_t_x"><?php echo ($child[0]['title']); ?>列表</a>
                    <a href="/Admin/Article/add?cid=<?php echo ($child[0]['id']); ?>">文档添加</a><?php endif; ?>
                <?php else: ?>
                <a href="#" id="admin_bg_t_x"><?php echo ($column["title"]); ?>列表</a>
                <a href="/Admin/Article/add?cid=<?php echo ($_GET['cid']); ?>">文档添加</a><?php endif; ?>
            <!--<a href="/Admin/Article/add">客服添加</a>-->
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg4">编号(ID)</li>
                <li class="admin_bg4">标题(title)</li>
                <li class="admin_bg4">关键词(keywords)</li>
                <li class="admin_bg4">简介(description)</li>
                <li class="admin_bg4">状态</li>
                <li class="admin_bg4">添加时间</li>
                <li class="admin_bg4">操作</li>
            </ul>
            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                        <li class="admin_bg4"><?php echo ($vo["id"]); ?></li>
                        <li class="admin_bg4"><?php echo ($vo["title"]); ?></li>
                        <li class="admin_bg4"><?php echo ($vo["keywords"]); ?></li>
                        <li class="admin_bg4"><?php echo ($vo["description"]); ?></li>
                        <li class="admin_bg4"><?php if(($vo["status"]) == "0"): ?><span class="green" style="border:none;">正常</span><?php endif; if(($vo["status"]) == "1"): ?><span class="red" style="border:none;">禁用</span><?php endif; ?></li>
                        <li class="admin_bg4"><?php echo (date("Y-m-d",$vo["date"])); ?></li>
                        <li class="admin_bg4">
                            <a href="/Admin/Article/add?aid=<?php echo ($vo["id"]); ?>">编辑</a>
                            <?php if(($vo["status"]) == "0"): ?><a href="/Admin/Article/status?id=<?php echo ($vo["id"]); ?>&t=1&ct=<?php echo ($vo["column_id"]); ?>" class="check-status">禁用</a><?php else: ?><a href="/Admin/Article/status?id=<?php echo ($vo["id"]); ?>&t=0&ct=<?php echo ($vo["column_id"]); ?>" class="check-status">正常</a><?php endif; ?>
                            <a href="/Admin/Article/del?id=<?php echo ($vo["id"]); ?>" class="confirm" data-role="您确定要删除吗？删除后数据将不能恢复！">删除</a>
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