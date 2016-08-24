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
        <img src="/Public/Home/images/logo1.fw.png" class="top_img img1">
        <img src="/Public/Home/images/logo2.fw.png" class="top_img img2">
        <img src="/Public/Home/images/logo3.fw.png" class="top_img img3">
        <img src="/Public/Home/images/logo4.fw.png" class="top_img img4">
        <span class="tips1"></span>
        <span class="tips2"></span>
        <span class="tips3"></span>
    </div>
</div>
<div class="main">
    <!-- 主体左边 -->
    <div class="main_left" style="border-right: 0;">
        <div class="left_title" style="float: left;padding-top: 3px;">
            <b class="gift_token1">礼品券</b>
            <i class="gift_token2">GIFT COUPONS</i>
        </div>
        <div class="gift_token">
            <b class="wihe1 yhq_bg gift_token_bg1"><img src="/Public/Home/images/yhq_bg1.fw.png" /></b>
            <em class="wihe2 yhq_bg gift_token_bg2"><img src="/Public/Home/images/yhq_bg2.fw.png" /></em>
				<span class="gift_token_left">
					<h2><?php echo ($vo["coupons_title"]); ?></h2>
					<strong>
                        <?php echo (get_pro_details1($vo['coupons_product']['description'])); ?>
                    </strong>
				</span>
				<span class="gift_token_right">
					<h2>礼品券</h2>
					<h3>￥<?php echo ($vo['coupons_product']['tprice']); ?></h3>
					<a href="javascript:void(0);" class="raisecar addcar couponcar" style="margin: 53px 0 0 0;" data-id="<?php echo ($vo["coupon_cid"]); ?>" data-sum="0" data-type="coupon">加入购物车</a>
				</span>
        </div>
    </div>
    <!-- 主体右边 -->
    <div class="main_right">
        <div class="right_top">
            <div class="shopping_area widthone">
                <a href="<?php echo U('Coupon/index');?>" class="shopping_check blue_bg">
                    <i>GIFT COUPONS</i>
                    <b>礼品券<font>购买</font></b>
                </a><a href="<?php echo U('product/list_dzx');?>" class="shopping_check claret_red_bg">
                <i>BOX SECTION</i>
                <b>礼盒专区<font>购买</font></b>
            </a><a href="<?php echo U('redwine/index');?>" class="shopping_check orange_bg">
                <i>HOT SELL</i>
                <b>红酒专区<font>购买</font></b>
            </a>
            </div>
        </div>
        <!-- 数据 -->
        <div class="right_gmr">
    <h4>&gt;&gt; 已有 <span><?php echo ($count); ?></span> 位用户，购买了礼品券</h4>
    <div class="gmr_list" id="marquee">
        <ul>
        <?php if(is_array($get_order)): $i = 0; $__LIST__ = $get_order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$od): $mod = ($i % 2 );++$i;?><li>
                <i><?php echo (substr_cut($od["username"])); ?></i>
                <b>已成功购买了《8只豪华装礼盒》</b>
                <em class="dd_right"><?php echo (date("Y-m-d h:i",$od["finishtime"])); ?></em>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script src="/Public/Home/js/scroll.js"></script>
<script type="text/javascript">
    $(function(){
        $("#marquee").myScroll({
            speed:80, //数值越大，速度越慢
            rowHeight:40 //li的高度
        });
    });
</script>
    </div>
    <div class="clear"></div>
    <!-- 编辑器 -->
    <div class="main_edit">
        <h3>商品介绍</h3>
        <div class="edit_info">
            <?php echo (htmlspecialchars_decode($vo["coupon_content"])); ?>
        </div>
    </div>
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
            $("#end").html("");
        }else{
            $("#end").html("<i>"+sums+"</i>");
        }

        $(".addcar").click(function(event){
            console.log($.cookie());
            $addcar = $(this);
            $type = $addcar.attr('data-type');
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

            //写入购物车操作
            $id = $addcar.attr('data-id');
            $sum = $addcar.attr('data-sum');
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