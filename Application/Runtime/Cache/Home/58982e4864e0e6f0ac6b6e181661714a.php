<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo C('SiteConfig.title');?>|首页</title>
    <meta name="keyword" content="<?php echo C('SiteConfig.keyword');?>" >
    <meta name="description" content="<?php echo C('SiteConfig.description');?>" >
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
    <script type="text/javascript" src="/Public/Home/js/jquery.min-1.7.1.js"></script>
    <script type="text/javascript" src="/Public/Home/js/tool.js"></script>

    <!-- 联系客服 开始 -->
    <link href="/Public/Home/css/lrtk.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Home/js/lrtk.js"></script>
    <!-- 联系客服 结束 -->

    <!-- 加入购物车 开始 -->
    <style type="text/css">.u-flyer{display: block;width: 100px;height: 100px;border-radius: 50%;position: fixed;z-index: 9999;}</style>
    <script type="text/javascript" src="/Public/Home/js/fly/jquery.fly.min.js"></script>
    <!-- 加入购物车 结束 -->
    <script type="text/javascript" src="/Public/Home/js/jquery.cookie.js"></script>
</head>
<body>
<!-- 站头 -->
<div class="header">
    <div class="top">
        <a href="<?php echo U('index/index');?>"><img src="/Public/Home/images/logo.fw.png" class="top_img img1"></a>
        <img src="/Public/Home/images/logo2.fw.png" class="top_img img2">
        <img src="/Public/Home/images/logo3.fw.png" class="top_img img3">
        <img src="/Public/Home/images/logo4.fw.png" class="top_img img4">
        <span class="tips1"></span>
        <span class="tips2"></span>
        <span class="tips3"></span>
        <a href="<?php echo U('index/index');?>" class="back_home">首页</a>
    </div>
</div>
<div class="main">
    <div class="main_top">
        <div class="main_top_left">
            <div class="left_title" style="float: left; padding-top: 3px;">
                <b class="hot_sell1">红酒专区</b>
                <i class="hot_sell2">HOT SELL</i>
            </div>
            <div class="top_left_nav hairycrab">
                <a href="<?php echo U('redwine/index');?>" class="gray_bg3 gray_col2" <?php if(empty($hg)): ?>id="allcheck"<?php endif; ?>>全部</a>
                <a href="<?php echo U('redwine/index?&to=199');?>" class="gray_bg3 gray_col2" <?php if(($hg) == "1"): ?>id="allcheck"<?php endif; ?> >0-199</a>
                <a href="<?php echo U('redwine/index?from=200&to=399');?>" class="gray_bg3 gray_col2" <?php if(($hg) == "2"): ?>id="allcheck"<?php endif; ?>>200-399</a>
                <a href="<?php echo U('redwine/index?from=400&to=599');?>" class="gray_bg3 gray_col2" <?php if(($hg) == "4"): ?>id="allcheck"<?php endif; ?>>400-599</a>
                <a href="<?php echo U('redwine/index?from=600');?>" class="gray_bg3 gray_col2" <?php if(($hg) == "6"): ?>id="allcheck"<?php endif; ?>>600+</a>
            </div>
            <div class="shopping_area" style="float: right;">
                <a href="<?php echo U('Coupon/index');?>" class="shopping_check blue_bg">
                    <i>GIFT COUPONS</i>
                    <b>礼品券<font>购买</font></b>
                </a><a href="<?php echo U('Coupon/index?ty=2');?>" class="shopping_check claret_red_bg">
                <i>BOX SECTION</i>
                <b>礼盒专区<font>购买</font></b>
            </a>
            </div>
        </div>
        <div class="main_top_right"></div>
    </div>
    <div class="proudct_list small_product_list">
        <!-- 产品 -->
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="product_info small_product" title="<?php echo ($vo["title"]); ?>">
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
						<b><?php echo (sub_str($vo["title"],0,9)); ?></b>
						<u>产品规格</u>
						<?php echo (get_pro_details($vo["description"])); ?>
					</span>
                    <div class="clear"></div>
                    <a href="<?php echo U('redwine/details?id='.$vo['id']);?>" class="raisecar raisecar_pos">查看详情</a>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="clear"></div>
</div>
<!-- 站尾 -->
<div class="footer">
    <address>Copyright©2005-2015,Suxiege Co.,Ltd. All right reserved. 所有内容均由阳澄湖大闸蟹制作，未经许可不得转载</address>
    <i>经营许可证编号: 沪ICP备15028124号</i>
    <b>味道鲜美正是食蟹的大好时节</b>
    <img src="/Public/Home/images/logo.fw.png">
</div>
<script type="text/javascript" src="/Public/Plug/layer-v2.2/layer/layer.min.js"></script>
<!-- 联系客服 -->
<div id="top">
    <div id="izl_rmenu" class="izl-rmenu">
        <a href="#" id="end" class="btn btn-gwc"></a>
        <a href="tencent://Message/?Uin=123456789&websiteName=www.lanrentuku.com=&Menu=yes" class="btn btn-qq"></a>
        <div class="btn btn-wx">
            <img class="pic" src="/Public/Home/images/weixin.jpg" onclick="window.location.href='http://www.lanrentuku.com'"/>
        </div>
        <div class="btn btn-phone">
            <div class="phone">
                15371829847
            </div>
        </div>
        <div class="btn btn-top">
        </div>
    </div>
</div>
<script src="/Public/Home/js/baguettebox.min.js" type="text/javascript"></script>
<script src="/Public/Home/js/jquery.cookie.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('.btn-gwc').click(function (e) {
            $sum = $("#end").find('i').text();
            if($sum==''){
                layer.alert('您还没有选购任何产品，请先选购物品',{icon:2});
                return false;
            }

            $.post('<?php echo U("product/addCart");?>',$.cookie(),function (data) {
                if(data.status==1){
                    window.location.href=data.redirect;
                }
            });
        });
    
        // 加入购物车特效
        var offset = $("#end").offset();
        var cookies = $.cookie();
        console.log($.cookie());
        $type = $('.addcar').attr('data-type');
        if($type=='coupon'){
            $('.addcar').attr('data-sum',get_cookie_sum(cookies['short_cart_coupon']));
        }else if ($type=='goods'){
            $('.addcar').attr('data-sum',get_cookie_sum(cookies['short_cart_goods']));
        }else {
            $('.addcar').attr('data-sum',get_cookie_sum(cookies['short_cart_wine']));
        }

        var sums = get_cookie_sum($.cookie('short_cart_sums'));
        if(sums<=0){
            if('<?php echo ($nums); ?>'>0){
                $("#end").html("<i>"+'<?php echo ($nums); ?>'+"</i>");
            }else{
                $("#end").html("");
            }
        }else{
            $("#end").html("<i>"+sums+"</i>");
        }

        $(".addcar").click(function(event){
            $addcar = $(this);
            $type = $addcar.attr('data-type');

            //写入购物车操作
            $id = $addcar.attr('data-id');
            $sum = $addcar.attr('data-sum');

            $.post('<?php echo U("product/check_pro");?>',{t:$type,id:$id},function (data) {
                if(data.status==0){
                    layer.alert(data.msg,{icon:2});
                }else{
                     //飞入购物车效果
                    if($type!='coupon'){
                        $image = $addcar.parent('div.product_price').siblings('strong.product_img');
                        var flyer = $('<img class="u-flyer" src="'+$image.find('img').attr('src')+'">');
                    }else {
                        var flyer = $('<img class="u-flyer" src="/Public/Home/images/couponaddcar.jpg">');
                    }
                    //购物车效果
                    var top;
                    if($(document).scrollTop()>0){
                        top = event.pageY - $(document).scrollTop();
                    }else{
                        top = event.pageY;
                    }

                    flyer.fly({
                        start: {
                            left: event.pageX-300,
                            top: top-200
                        },
                        end: {
                            left: offset.left+10,
                            top: offset.top+10,
                            width: 0,
                            height: 0
                        },
                        onEnd: function(){
                            ++sums;
                            $("#end").html("<i>"+sums+"</i>");
                            $("#end").attr('href','javascript:void(0);');
                            $.cookie('short_cart_sums',sums,{expires: 1,path: '/'});
                        }
                    });


                    var sum1=1,sum2=1,sum3=1;
                    if($type=='coupon'){
                        sum1 = $sum;
                        ++sum1;
                        $.cookie('short_cart_coupon'+$id,['coupon',$id,sum1],{expires: 1,path:'/'});
                        $addcar.attr('data-sum',sum1);
                    }else if ($type=='goods'){
                        sum2 = $sum;
                        ++sum2;
                        $.cookie('short_cart_goods'+$id,['goods',$id,sum2],{expires: 1,path: '/'});
                        $addcar.attr('data-sum',sum2);
                    }else {
                        sum3 = $sum;
                        ++sum3;
                        $.cookie('short_cart_wine'+$id,['wine',$id,sum3],{expires: 1,path:'/'});
                        $addcar.attr('data-sum',sum3);
                    }
                }
            });
        });

        $('.fetch').live('click',function (e) {
            e.preventDefault();
            $val = $(this).siblings('input.ticket_code').val();
            if($val==''){
                layer.alert('请填写礼品券号',{icon:2});
                return false;
            }
            $.post("<?php echo U('Getgoods/details');?>",{no:$val},function (data) {
                if(data.status==0){
                    layer.alert(data.msg,{icon:2});
                }else {
                    $('.main').html(data);
                }
            });
        });

        $('#query').live('click',function (e) {
            e.preventDefault();
            $val = $('#ticket_code1').val();
            if($val==''){
                layer.alert('请填写单号',{icon:2});
                return false;
            }
            $.post('<?php echo U("query/get_url");?>',{no:$val},function (data) {
                if(data.status==1){
                    window.location.href=data.redirect;
                }else{
                    layer.alert(data.msg,{icon:2});
                }
            });
        });

        // 礼品券
        $('#current').click(function(){
            var ticket = "<input type=\"text\" name=\"ticket_code\" class=\"ticket_code\" placeholder=\"请输入礼品券编号\" /><input type=\"button\" name=\"fetch\" class=\"fetch\" value=\"领取\" />";
            $('#ticket_edit').attr("class","ticket_edit ticket1");
            $('#ticket_edit').html(ticket);
        });
        // 订单信息
        $('#logistics').click(function(){
            var ticket = '<input type="text" name="ticket_code" id="ticket_code1" class="ticket_code" placeholder="请输入订单号" /><a href="javascript:void(0);" id="query">查询</a>';
            $('#ticket_edit').attr("class","ticket_edit ticket2");
            $('#ticket_edit').html(ticket);
        });


    });
    /**
     * 获取数量
     * @param cookie
     * @returns {*}
     */
    function get_cookie_sum(cookie) {
        if(cookie==undefined){
            return 0;
        }else {
            return  parseInt(cookie);
        }

    }

    function clearCookie(){
        var keys=document.cookie.match(/[^ =;]+(?=\=)/g);
        if (keys) {
            for (var i = keys.length; i--;){
                if(keys[i]!='PHPSESSID'){
                    $.cookie(keys[i], '', { expires: -1,path:'/' }); // 删除 cookie
                }
            }
        }
    }
</script>
</body>
</html>