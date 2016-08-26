<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>阳澄湖大闸蟹专卖店</title>
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/base.css">
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/wap.css">
    <script type="text/javascript" src="/Public/Wap/js/jquery.min.js"></script>
</head>
<body>
<div class="header">
    <a href="<?php echo U('index/index');?>" class="home"><img src="/Public/Wap/images/home.fw.png" /></a>
</div>
<div class="main padd">
    <div class="query_title">
        <div class="query_enter">
            <div class="query_enter_top">
                <b class="red_bg" id="current">领取礼盒</b><b class="gray_bg" id="logistics">查询订单状态</b>
            </div>
            <div class="query_enter_down">
                <input type="text" placeholder="请输入订单号" class="enter2" />
                <input type="button" value="查询" class="draw2 gray_bg" />
            </div>
        </div>
        <!-- 无物流信息 -->
        <div class="nothing">
            暂无物流信息
        </div>
        <!-- 有物流信息 -->
        <div class="wine_progream">因红酒无法空运，我们将双向发货！请注意查收您购买的商品，如有任何问题请联系在线客服</div>
    </div>
    <div id="continer" style="display:none;">
        <!-- 商品列表 -->
        <div class="cart_pro_list">
            <!-- 商品 -->
            <div class="cart_product">
                <label>
                    <b><img src="images/prduct1.fw.png"></b>
                </label>
				<span>
					<h3>8只大众蟹豪华礼盒</h3>
					<p class="gray_col2">4只公蟹2.5-3两</p>
					<p class="gray_col2">4只母蟹2.0-2.5两</p>
					<strong>
                        <input type="button" name="minus" value="-" class="jiajian minus" />
                        <input type="number" name="num" value="1" class="number">
                        <input type="button" name="plus" value="+" class="jiajian plus" />
                    </strong>
					<h2 class="red_col">￥999.00</h2>
				</span>
            </div>
            <!-- 商品 -->
            <div class="cart_product">
                <label>
                    <b><img src="images/prduct1.fw.png"></b>
                </label>
				<span>
					<h3>8只大众蟹豪华礼盒</h3>
					<p class="gray_col2">4只公蟹2.5-3两</p>
					<p class="gray_col2">4只母蟹2.0-2.5两</p>
					<strong>
                        <input type="button" name="minus" value="-" class="jiajian minus" />
                        <input type="number" name="num" value="1" class="number">
                        <input type="button" name="plus" value="+" class="jiajian plus" />
                    </strong>
					<h2 class="red_col">￥999.00</h2>
				</span>
            </div>
            <!-- 商品 -->
            <div class="cart_product">
                <label>
                    <b><img src="images/prduct1.fw.png"></b>
                </label>
				<span>
					<h3>8只大众蟹豪华礼盒</h3>
					<p class="gray_col2">4只公蟹2.5-3两</p>
					<p class="gray_col2">4只母蟹2.0-2.5两</p>
					<strong>
                        <input type="button" name="minus" value="-" class="jiajian minus" />
                        <input type="number" name="num" value="1" class="number">
                        <input type="button" name="plus" value="+" class="jiajian plus" />
                    </strong>
					<h2 class="red_col">￥999.00</h2>
				</span>
            </div>
        </div>
        <div class="clear"></div>
        <!-- 用户信息 -->
        <div class="user_info">
            <!-- 购买人 -->
            <div class="sl_user">
                <h3>购买人信息</h3>
                <input type="text" name="suser" placeholder="姓名">
                <input type="tel" name="sphone" placeholder="联系电话">
            </div>
            <!-- 收货人 -->
            <div class="sl_user">
                <h3>收货人信息</h3>
                <input type="text" name="suser" placeholder="姓名">
                <input type="tel" name="sphone" placeholder="联系电话">
                <style type="text/css">
                    ._citys{width: 97%;}
                </style>
                <input type="text" name="city" readonly="true" id="city" placeholder="选择省市">
                <textarea placeholder="街道信息"></textarea>
            </div>
        </div>
        <div class="query_info">
            <div class="query_info_title">
                <h4>物流信息<span class="coupon_bg">礼品券</span></h4>
                <h4>
                    顺丰单号/<font class="red_col">K6544165412345</font>
                    <input type="checkbox" checked="checked" id="logistics" />
                    <label for="logistics">到付</label>
                </h4>
            </div>
            <div class="logistics_info"></div>
        </div>
        <div class="query_info">
            <div class="query_info_title">
                <h4 style="font-size: 1.2em;">物流信息<span class="wine_bg">红酒</span></h4>
                <h4 class="gray_col2">
                    顺丰单号/<font class="red_col">K6544165412345</font>
                    <input type="checkbox" checked="checked" id="logistics" />
                    <label for="logistics">到付</label>
                </h4>
            </div>
            <div class="logistics_info"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="footer"></div>
<!-- 底部导航栏 -->
<div class="mytools">
    <a href="<?php echo U('Getgoods/index');?>" class="my_float_l">礼品券兑换</a>
    <a href="javascript:void(0);" class="my_cart"><b>购物车</b></a>
    <a href="<?php echo U('query/index');?>" class="my_float_r">订单查询</a>
</div>
<script src="/Public/Wap/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Public/Wap/js/layer/layer.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        // 礼券
        $('#current').click(function(){
            var content = '<input type="text" placeholder="请输入礼品券号码" class="enter1" /><input type="button" value="领取" class="draw1 red_bg" />';
            $('.query_enter_down').html(content);
        });
        // 订单
        $('#logistics').click(function(){
            var content = '<input type="text" placeholder="请输入订单号" class="enter2" /><input type="button" value="查询" class="draw2 gray_bg" />';
            $('.query_enter_down').html(content);
        });
        $('.draw1').live('click',function (e) {
            e.preventDefault();
            var no = $('.enter1').val();
            if(no==''){
                layer.alert('请输入礼品券',{icon:2});
                return false;
            }
            $.post("<?php echo U('Getgoods/details');?>",{no:no},function (data) {
                if(data.status==0){
                    layer.alert(data.msg,{icon:2});
                }else {
                    $('#addHtml').html(data);
                }
            });
        });
        $('.draw2').live('click',function (e) {
            e.preventDefault();
            var no = $('.enter2').val();
            if(no==''){
                layer.alert('请输入订单号',{icon:2});
                return false;
            }
            $.post('<?php echo U("query/get_url");?>',{no:no},function (data) {
                if(data.status==1){
                    window.location.href=data.redirect;
                }else{
                    layer.alert(data.msg,{icon:2});
                }
            });
        });
        $('.my_cart').click(function (e) {
            e.preventDefault();

            $sum = $(this).find('i').text();
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
        var cookies = $.cookie();

        $type = $('#addcart').attr('data-type');
        if($type=='coupon'){
            $('.addcart').attr('data-sum',get_cookie_sum(cookies['wap_short_cart_coupon']));
        }else if ($type=='goods'){
            $('#addcart').attr('data-sum',get_cookie_sum(cookies['wap_short_cart_goods']));
        }else {
            $('#addcart').attr('data-sum',get_cookie_sum(cookies['wap_short_cart_wine']));
        }

        var sums = get_cookie_sum($.cookie('wap_short_cart_sums'));
        if(sums<=0){
            $(".my_cart").html("<b>购物车</b>");
        }else{
            $(".my_cart").html("<b>购物车</b>"+"<i>"+sums+"</i>");
        }

        $("#addcart").click(function(event){
            event.preventDefault();
            $addcar = $(this);
            $type = $addcar.attr('data-type');

            //写入购物车操作
            $id = $addcar.attr('data-id');
            $sum = $addcar.attr('data-sum');
            var sum1=1,sum2=1,sum3=1;
            if($type=='coupon'){
                sum1 = $sum;
                ++sum1;
                $.cookie('wap_short_cart_coupon'+$id,['coupon',$id,sum1],{expires: 1,path:'/'});
                $addcar.attr('data-sum',sum1);
            }else if ($type=='goods'){
                sum2 = $sum;
                ++sum2;
                $.cookie('wap_short_cart_goods'+$id,['goods',$id,sum2],{expires: 1,path: '/'});
                $addcar.attr('data-sum',sum2);
            }else {
                sum3 = $sum;
                ++sum3;
                $.cookie('wap_short_cart_wine'+$id,['wine',$id,sum3],{expires: 1,path:'/'});
                $addcar.attr('data-sum',sum3);
            }
            ++sums;
            $.cookie('wap_short_cart_sums',sums,{expires: 1,path: '/'});
            $('.my_cart').html("<b>购物车</b>"+'<i>'+ sums +'</i>');
            $(".my_cart").attr('href','javascript:void(0);');
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