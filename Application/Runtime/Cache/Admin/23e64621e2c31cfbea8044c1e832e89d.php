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
    <div class="admin_bg_t">
        <a href="/Admin/Column/index">返回列表</a>
        <a href="/Admin/Column/add?gid=10" id="admin_bg_t_x">文档添加</a>
    </div>
    <form action="/Admin/Column/addhandler" method="post">
        <div class="admin_bg_fb">
             <span>
                 <em>栏目名称</em>
                 <input name="title" type="text"  value="<?php echo ($column["title"]); ?>" id="title" class="required">
                 <input type="hidden" name="id" value="<?php echo ($column["id"]); ?>">
            </span>
            <span>
                 <em>英文名称</em>
                 <input name="name" type="text"  value="<?php echo ($column["name"]); ?>" id="name" class="required">
            </span>
            <span>
                <em>父栏目</em>
                 <select class="span4 m-wrap" name="fid">
                     <option value="0">顶级栏目</option>
                     <?php if(is_array($column_list)): $i = 0; $__LIST__ = $column_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate["id"]); ?>" <?php if(($cate["id"]) == $column["fid"]): ?>selected='selected'<?php endif; ?>><?php echo ($cate["html"]); echo ($cate["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                 </select>
            </span>
            <span>
                <em>关键词</em>
                <textarea name="keywords"><?php echo ($column["keywords"]); ?></textarea>
            </span>
            <span>
                <em>描述</em>
                <textarea name="description"><?php echo ($column["description"]); ?></textarea>
            </span>
            <span>
                <em>栏目类型</em>
                <label>
                    <input type="radio" name="type" value="1"   <?php if(($column["type"]) == "1"): ?>checked<?php endif; ?> <?php if(empty($column["type"])): ?>checked<?php endif; ?>>列表页
                </label>
                <label>
                    <input type="radio" name="type"   value="2"  <?php if(($column["type"]) == "2"): ?>checked<?php endif; ?>>下载页
                </label>
                <label>
                    <input type="radio" name="type"  value="3"  <?php if(($column["type"]) == "3"): ?>checked<?php endif; ?>>单页面
                </label>
                <label>
                    <input type="radio" name="type"   value="4"  <?php if(($column["type"]) == "4"): ?>checked<?php endif; ?>>封面页
                </label>
                <label>
                    <input type="radio" name="type"  value="5"  <?php if(($column["type"]) == "5"): ?>checked<?php endif; ?>>表单
                </label>
                <label>
                    <input type="radio" name="type"   value="6"  <?php if(($column["type"]) == "6"): ?>checked<?php endif; ?>>跳转页
                </label>
                <label for="cover" class="<?php if(($column["cover"]) != "6"): ?>hide<?php endif; ?> data-cover"><input type="text" placeholder="请输入封面地址" id="cover" value="<?php echo ($column["tpl"]); ?>" name="tpl"/></label>
                <label for="uri" class="<?php if(($column["cover"]) != "6"): ?>hide<?php endif; ?> data-redirect"><input type="text" placeholder="请输入跳转地址" id="uri" value="<?php echo ($column["uri"]); ?>"  name="uri"/></label>
            </span>
            <span>
                <em>栏目位置</em>
                <label>
                    <input type="radio" name="position"  value="1" <?php if(($column["position"]) == "1"): ?>checked<?php endif; ?> <?php if(empty($column["position"])): ?>checked<?php endif; ?>>顶部
                </label>
                <label>
                    <input type="radio" name="position" value="2" <?php if(($column["position"]) == "2"): ?>checked<?php endif; ?>>居中
                </label>
                <label>
                    <input type="radio" name="position"  value="3" <?php if(($column["position"]) == "3"): ?>checked<?php endif; ?>>居左
                </label>
                <label>
                    <input type="radio" name="position"  value="4" <?php if(($column["position"]) == "4"): ?>checked<?php endif; ?>>居右
                </label>
                <label>
                    <input type="radio" name="position" value="5" <?php if(($column["position"]) == "5"): ?>checked<?php endif; ?>>底部
                </label>
            </span>
            <span>
                <em>扩展参数</em>
                <input name="attach" type="text" value="<?php echo ($column["attach"]); ?>">
                <div class="tip" style="display:block;float:left;padding-right:6px;">*附加信息使用","和"|"隔开,如:"price,10|coupon,1"</div>
            </span>
            <span>
                <em>排序</em>
                <input name="sort" type="text" <?php if(!empty($arc["sort"])): ?>value="<?php echo ($column["sort"]); ?>"<?php else: ?>value="100"<?php endif; ?> style="">
                <div class="tip" style="display:block;float:left;padding-right:6px;">*越小越靠前</div>
            </span>
             <span>
                <em>状态</em>
                <label>
                    <input name="status" type="radio" value="0" <?php if(($column["status"]) == "0"): ?>checked<?php endif; ?> <?php if(empty($arc["status"])): ?>checked<?php endif; ?>>正常
                </label>
                <label>
                    <input name="status" type="radio" value="1"  <?php if(($column["status"]) == "1"): ?>checked<?php endif; ?>>锁定
                </label>
            </span>
            <div class="admin_bg_b2 admin_bg_b3">
                <?php if(empty($column)): ?><input name="" type="submit" value="确认添加">
                    <?php else: ?>
                    <input name="" type="submit" value="确认修改"><?php endif; ?>
            </div>
        </div>
    </form>
</div>
<script  type="text/javascript">
    $(function () {
        $('form').validate();
        $('form').submit(function (e) {
            e.preventDefault();
            if($('form').valid()){
                $(this).ajaxSubmit({
                    success:function (data) {
                        if(data.status==0){
                            layer.msg(data.msg,{icon:2});
                        }else{
                            redirect(data.redirect,data.msg,2);
                        }
                    }
                })
            }
        });

        $('.reset-radio').click(function(){
            $val=$(this).val();
            if($val==6 || $val==4){
                if($val==6){
                    $('.data-redirect').show();
                    $('#cover').val('');
                    $('.data-cover').hide();
                }
                if($val==4){
                    $('.data-cover').show();
                    $('#uri').val('');
                    $('.data-redirect').hide();
                }
            }else{
                $('.data-redirect').hide();
                $('.data-cover').hide();
                $('#uri').val('');
                $('#cover').val('');
            }
        });
    });
</script>
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