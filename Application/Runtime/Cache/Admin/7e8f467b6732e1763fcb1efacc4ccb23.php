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
<!-- JS上传 -->
<link rel="stylesheet" href="/Public/Plug/chosen-master/public/chosen.css" />
<link rel="stylesheet" href="/Public/Plug/Uploadify/uploadify.css" />
<script type="text/javascript" src="/Public/Plug/chosen-master/public/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/Public/Plug/Uploadify/jquery.uploadify.min.js"></script>
<style>
    .imageDiv{float: left; margin-right: 12px;}
    .imageDiv>img{float: left;}
    .imageDiv>.removeImage{margin: 4px 0px 0px -4px; cursor: pointer;}
</style>
<!-- JS上传end -->
<script src="/Public/Plug/kindeditor-4.1.10/kindeditor-all-min.js"></script>
<div class="admin_r_all" style="height: 555px;">
    <div class="admin_bg_t">
        <a href="/Admin/Coupons/index">返回列表</a>
        <a href="/Admin/Coupons/add" id="admin_bg_t_x">文档添加</a>
    </div>
    <form action="/Admin/Coupons/addhd" method="post">
        <div class="admin_bg_fb">
             <span>
                 <em>礼券名称</em>
                 <input name="coupons_title" type="text" value="" class="required">
            </span>
            <span style="display:none;" id="coupons_pre">
                 <em>礼券前缀</em>
                 <input name="coupons_pre" type="text" value="" class="required">
            </span>
            <span>
                <em>礼券类型</em>
                <select name="coupons_type" id="coupons_type">
                    <option value="-1">--请选择类型--</option>
                    <option value="0">实物</option>
                    <option value="1">折扣</option>
                    <option value="2">现金</option>
                </select>
            </span>
            <span>
                <em>礼券面值</em>
                <span id="coupons_val_type"><input name="coupons_val" type="text"  class=""></span>
            </span>
            <span style="display:none;" id="coupons_val_cls">
                <em>对应商品</em>
            </span>
            <span>
                <em>生成数量</em>
                <input name="coupons_sum" type="text" id="coupons_sum" value=""  class="required">
            </span>
            <span>
                <em>礼券介绍</em>
                <textarea id="coupon_content" name="coupon_content"></textarea>
            </span>
            <div class="admin_bg_b2 admin_bg_b3">
                <input name="" type="submit" value="确认添加">
            </div>
        </div>
    </form>
</div>
<script  type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="coupon_content"]', {
            allowFileManager : true,//是否显示图片空间:true是; false否;
            //resizeType: 0,//输入框拖拽大小:0不可拖拽; 1只改变高度; 2改变宽度和高度;
            width : "780px",
            height : "450px",
            uploadJson:"<?php echo U('Uploadify/KindEditorUploadImage');?>",
            afterBlur: function(){this.sync();}
        });
    });
   $(function () {
       $('form').validate();
       $('form').submit(function (e) {
           e.preventDefault();
           if($('form').valid()){
               if($('#coupons_type').val()==-1){
                   layer.msg('请选择礼券类型',{icon:2});
                   return false;
               }
               if($('#coupons_sum').val() == 0 ){
                   layer.msg('请选择生成实物券栏目',{icon:2});
                   return false;
               }
               if($('#coupons_val').val()<=0){
                   layer.msg('请选择生成实物券数目',{icon:2});
                   return false;
               }
//               if(editor.text()==''){
//                   layer.msg('请选择生成实物券数目',{icon:2});
//                   return false;
//               }
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

       $('#coupons_type').change(function () {
           var val = $(this).val();
           switch (val){
               case "0":
                   $('#coupons_val_type').siblings('em').text('对应栏目');
                   $('#coupons_pre').hide();
                   $.post('/Admin/Coupons/get_columns',function (data) {
                       if(data.status==1){
                           $('#coupons_val_type').empty().html(data.result);
                       }else{
                           layer.msg(data.msg,{icon:2});
                       }
                   });
                   break;
               case "1":
               case "2":
                   $('#coupons_val_type').siblings('em').text('礼券面值');
                   $('#coupons_val_type').empty().append('<input name="coupons_val" type="text" class="required">');
                   $('#coupons_pre').show();
                   $('#coupons_val_cls').hide();
                   break;
           }
       });
   });
   /**
    * 获取目标数量
    * @param obj
    */
    function changeVal(obj) {
        var o = $(obj);
        var val =o.val();
        if(val==-1){
            layer.msg('请选择生成实物券的栏目',{icon:2});
        }
        $.post('/Admin/Coupons/get_article_list',{cid:val},function (data) {
            if(data.status==1){
                $('#coupons_val_cls').empty().append("<em>对应商品</em>"+data.result);
                $('#coupons_val_cls').show();
                //$('#coupons_sum').val(data.result);
            }else{
                layer.msg(data.msg,{icon:2});
                $('#coupons_val_cls').empty().append("<em>对应商品</em>");
                $('#coupons_sum').val(0);
            }
        });
    }

    function changeVals(obj) {
        var o = $(obj);
        var val =o.val();
        if(val==-1){
            layer.msg('请选择产品',{icon:2});
        }
        $.post('/Admin/Coupons/get_article_count',{cid:val},function (data) {
            if(data.status==1){
                $('#coupons_sum').val(data.result);
            }else{
                layer.msg(data.msg,{icon:2});
                $('#coupons_sum').val(0);
            }
        });
    }
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