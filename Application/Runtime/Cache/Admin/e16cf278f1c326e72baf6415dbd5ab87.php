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
<div class="admin_r_all">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="/Admin/Article/index?cid=<?php echo ($_GET['cid']); echo ($info["column_id"]); ?>">返回列表</a>
            <a href="/Admin/Article/add?cid=10" id="admin_bg_t_x">文档添加</a>
        </div>
        <form action="/Admin/Article/addhandler" method="post">
            <div class="admin_bg_fb">
	        	<span>
	            	<em>标题</em>
	                <input type="type" name="title" id="title" value="<?php echo ($info["title"]); ?>" class="required"/>
	            </span>
                 <span>
	            	<em>所属栏目</em>
	                <select name="column_id" id="cid">
                        <option value="0">-请选择栏目-</option>
                        <?php if(is_array($column)): $i = 0; $__LIST__ = $column;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $_GET['cid']): ?>selected="selected"<?php endif; ?> <?php if(($vo["id"]) == $info["column_id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
	            </span>
                 <!--<span>-->
	            	<!--<em>类型</em>-->
	                <!--<select name="tid" id="tid">-->
                        <!--<option value="0">-请选择类型-</option>-->
                            <!--<option value="0" <?php if(($info["tid"]) == "0"): ?>selected="selected"<?php endif; ?>>礼券</option>-->
                            <!--<option value="1" <?php if(($info["tid"]) == "1"): ?>selected="selected"<?php endif; ?>>礼盒</option>-->
                    <!--</select>-->
	            <!--</span>-->
	            <span>
	            	<em>关键词</em>
	                <input type="text" name="keywords" value="<?php echo ($info["keywords"]); ?>" id="car_brand">
	            </span>
	            <span>
	            	<em>描述</em>
                    <!-- <div class="admin_bjq">编辑器</div> -->
	                <textarea name="description" id="description"><?php echo ($info["description"]); ?></textarea>
                     <div class="tip" style="padding-left:10px;line-height:50px;">多个请使用"，"隔开(中文)</div>
	            </span>
	            <span>
	            	<em>景点封面</em>
                    <!-- <input type="button" name="task_imgs" id="task_imgs" size="16" value="上传"/> -->
	            	<div>
                        <div style="float:left; margin-top:8px;"><input type="button" name="fileImg" id="fileImg" size="16" value="上传" class="table_btn"/></div>
                        <div style="float:left; margin-top:7px; cursor:pointer;font-size:14px;" onclick="imgView('master');return false;" id="img_b">查看</div>
                        <div style="float:left; margin-left:10px; margin-top:8px;" id="img_c"><img src="/Public/Admin/images/ldx.png" style="cursor:pointer;" onclick="noMasterImg()" /></div>
                        <div style="clear:both;"></div>
                    </div>
	            </span>
	            <span>
	            	<em>封面预览</em>
                    <?php if(!empty($info["image"])): ?><img src="<?php echo ($info["image"]); ?>" id="images_preview" width="380" height="auto">
                        <?php else: ?>
                        <img src="" id="images_preview" width="380" height="auto" style="display:none;"><?php endif; ?>
	            </span>
                <span>
	            	<em>价格</em>
	                <input type="text" name="price" value="<?php echo ($info["price"]); ?>" id="price" >
	            </span>
                <span>
	            	<em>特价</em>
	                <input type="text" name="tprice" value="<?php echo ($info["tprice"]); ?>" id="tprice">
	            </span>
                <span>
	            	<em>数量</em>
	                <input type="text" name="sum" value="<?php echo ($info["sum"]); ?>" id="sum">
	            </span>
                <span>
	            	<em>质量</em>
	                <input type="text" name="mass" value="<?php echo ($info["mass"]); ?>" id="mass">
	            </span>
	 			<!--<span>-->
	            	<!--<em>车身展示</em>-->
	                <!--<input type="button" id="J_selectImage" value="批量上传" />-->
	            <!--</span>-->
                <!--<div id="J_imageView" style="padding-left: 93px;">-->

                    <!--<?php if(!empty($info["car_image"])): ?>-->
                        <!--<?php if(is_array($info["car_image"])): $i = 0; $__LIST__ = $info["car_image"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
							<!--<span class="imageDiv">-->
								<!--<img src="<?php echo ($vo); ?>" width="100" data-role=""><img src="/Public/images/ldx.png" class="removeImage" onclick="removeImage(this)">-->
								<!--<input type="hidden" name="car_image[]" value="<?php echo ($vo); ?>">-->
							<!--</span>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                    <!--<?php endif; ?>-->
                <!--</div>-->
                  <span>
                        <em>内容</em>
                        <textarea name="content" id="content"><?php echo ($info["content"]); ?></textarea>
                  </span>
                  <span>
                      <em>排序</em>
                      <input name="sort" id="sort" type="text" value="<?php if(!empty($info["sort"])): echo ($info["sort"]); else: ?>100<?php endif; ?>" >
                      <div class="tip" style="padding-left:10px;">*越小越靠前</div>
                  </span>
                  <span>
                      <em>状态</em>
                      <label>
                          <input type="radio" name="status" value="0" <?php if(empty($info["status"])): ?>checked<?php endif; ?>>正常
                      </label>
                       <label>
                           <input type="radio" name="status" value="1" <?php if(($info["status"]) == "1"): ?>checked<?php endif; ?>>禁用
                       </label>
                  </span>
                <div class="admin_bg_b2 admin_bg_b3">
                    <?php if($info["id"] == ''): ?><input name="add_spot" id="add_spot" type="submit" value="确认发布">
                        <?php else: ?>
                        <input name="edit_spot" id="edit_spot" type="submit" value="确认修改"><?php endif; ?>
                </div>
            </div>
            <input type="hidden" id="reply_img" value="<?php echo ($info["image"]); ?>" name="image" />
            <input type="hidden" id="id" value="<?php echo ($info["id"]); ?>" name="id" />
            <input type="hidden" value="<?php echo ($_GET['cid']); echo ($info["column_id"]); ?>" name="rid">
        </form>
    </div>
</div>
<script type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            allowFileManager : true,//是否显示图片空间:true是; false否;
            //resizeType: 0,//输入框拖拽大小:0不可拖拽; 1只改变高度; 2改变宽度和高度;
            width : "780px",
            height : "450px",
            uploadJson:"<?php echo U('Uploadify/KindEditorUploadImage');?>",
            afterBlur: function(){this.sync();}
        });
//        K('#J_selectImage').click(function() {
//            editor.loadPlugin('multiimage', function() {
//                editor.plugin.multiImageDialog({
//                    clickFn : function(urlList) {
//                        var div = K('#J_imageView');
//                        K.each(urlList, function(i, data) {
//                            div.append('<span class="imageDiv"><img src="' + data.url + '" width="100" data-role="'+i+'"><img src="/Public/images/ldx.png" class="removeImage" onclick="removeImage(this)"> <input type="hidden" name="car_image[]" value="'+data.url+'"></span>');
//                        });
//                        editor.hideDialog();
//                    }
//                });
//            });
//        });
    });
    $(function(){
        $('#img_b').hide();
        $('#img_c').hide();
        var spot_id = '<?php echo ($info["id"]); ?>';
        if(spot_id == ''){
            $('#images_preview').hide();
        }else{
            var reply_img = $('#reply_img').val();
            if(reply_img != ''){
                $('#img_b').show();
                $('#img_c').show();
            }
        }
        //验证表单
        $('form').submit(function(e){
            e.preventDefault();
            if($('#title').val()==''){
                layer.msg('请填写标题',{icon:2});
                return false;
            }
            if($('#cid').val()==0){
                layer.msg('请填选择所属栏目',{icon:2});
                return false;
            }
            if($('#price').val()==''){
                layer.msg('请填写价格',{icon:2});
                return false;
            }
            if($('#sum').val()==''){
                layer.msg('请填写数量',{icon:2});
                return false;
            }
            var text = editor.text();
            if(text==''){
                layer.msg('请填写主要内容',{icon:2});
                return false;
            }
            $action = $(this).attr('action');
            $query = $(this).serialize();
            var index = layer.load(2, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
            $.post($action,$query,function(data){
                if(data.status==1){
                    layer.close(index);
                    //window.location.href=data.redirect;
                    redirect(data.redirect,data.msg,2);
                }else{
                    layer.msg(data.msg,{icon:2});
                }
            });

        });
    });

    //图片
    function imgView(pic_url){
        if(pic_url == 'master'){
            pic_url = $('#reply_img').val();
        }
        art.dialog({
            padding: 0,
            width: false,
            height: false,
            title: '图片',
            // content: "<div style='width:400px; height:400px;'><img src='"+pic_url+"' width='400px' /></div>",
            content: "<div style='max-width:500px; max-height:400px; overflow:auto;'><img style='max-width:500px; max-height:400px; overflow:auto;' src='__HOST__/"+pic_url+"'  /></div>",
            lock: true
        });
    }

    //照片
    $("#fileImg").uploadify({
        fileTypeDesc   	: '图片文件',
        fileTypeExts  	: '*.png;*.jpg;*.jpeg;*.gif;',
        buttonText	  	: '选择图片',
        buttonClass   	: 'upload_button',
        swf           	: '/Public/Plug/Uploadify/uploadify.swf',
        uploader      	: "<?php echo U('Uploadify/uploadImg');?>",
        multi         	: false,
        onUploadSuccess : function(file, data, response) {
            $("#reply_img").val(data);
            $("#images_preview").attr('src',data);
            $('#images_preview').show();
            $('#img_b').show();
            $('#img_c').show();
        }
    });
    function noMasterImg(){
        $src = $("#images_preview").attr('src');
        $.post("<?php echo U('Uploadify/delmg');?>",{src:$src},function(data){
            if(data.status==1){
                layer.msg(data.msg,{icon:1});
                $("#reply_img").val('');
                $('#img_b').hide();
                $('#img_c').hide();
                $('#images_preview').hide();
            }else{
                layer.msg(data.msg,{icon:2});
            }
        });
    }

//    function removeImage(obj){
//        $obj=$(obj);
//        $parent = $obj.parent('span.imageDiv');
//        $src = $parent.children('img').eq(0).attr('src');
//        $.post("<?php echo U('Uploadify/delmg1');?>",{src:$src},function(data){
//            if(data.status==1){
//                $parent.remove();
//            }else{
//                art.dialog({time:1,content: data.msg});
//            }
//        });
//    }
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