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
<div class="main">
    <div class="main_product">
        <div class="main_product_top">
				<span>
					<h2><?php echo ($vo["title"]); ?></h2>
					<p><?php echo ($vo["description"]); ?></p>
				</span><h2>￥<?php echo ($vo["tprice"]); ?></h2>
        </div>
        <div class="product_img">
            <img src="<?php echo ($vo["image"]); ?>">
        </div>
    </div>
    <div class="clear"></div>
    <div class="main_lxpz">
			<span class="lxpz1">
				<img src="/Public/Wap/images/point3.fw.png">
			</span><span class="lxpz2">
				<img src="/Public/Wap/images/point1.fw.png">
			</span><span class="lxpz3">
				<img src="/Public/Wap/images/point2.fw.png">
			</span>
    </div>
    <div class="main_nav">
        <a href="<?php echo U('product/index?oid=1');?>" class="hairy_bg">
            礼品盒
        </a><a href="<?php echo U('product/index?oid=2');?>" class="coupon_bg">
        礼品券
    </a><a href="<?php echo U('product/index?oid=5');?>" class="wine_bg">
        红酒
    </a>
    </div>
    <!-- 商品介绍 -->
    <div class="product_info">
        <div class="groom_pro">
            <span>产品详情</span>
        </div>
        <div class="edit_console">
            <?php echo (htmlspecialchars_decode($vo["content"])); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="footer"></div>
<!-- 底部导航栏 -->
<div class="mytools">
    <a href="cart.html" class="my_cart pro_cart"><b>购物车</b></a>
    <a href="javascript:void(0);" id="addcart" class="my_float_r addcart blue_bg" data-id="<?php if(($_GET['t']) == "c"): echo ($vo["coupon_cid"]); else: echo ($vo["id"]); endif; ?>" data-sum="0" data-type="<?php if(empty($$coupon)): if(($vo["column_id"]) == "5"): ?>wine<?php else: ?>goods<?php endif; endif; echo ($coupon); ?>">加入购物车</a>
</div>
</body>
<script type="text/javascript" src="/Public/Wap/js/jquery.min.js"></script>
<script src="/Public/Wap/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Public/Wap/js/layer/layer.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
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
            $.post('<?php echo U("product/check_pro");?>',{t:$type,id:$id},function (data) {
                if(data.status==0){
                    layer.alert(data.msg,{icon:2});
                }else{
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
                    $('.my_cart').addClass('cart_tx');
                    setTimeout(function(){
                        $('.my_cart').removeClass('cart_tx');
                    },401);
                    ++sums;
                    $.cookie('wap_short_cart_sums',sums,{expires: 1,path: '/'});
                    $('.my_cart').html("<b>购物车</b>"+'<i>'+ sums +'</i>');
                    $(".my_cart").attr('href','javascript:void(0);');
                }
            });      
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
</html>