<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>阳澄湖大闸蟹专卖店</title>
    <link rel="stylesheet" type="text/css" href="/dzx/Public/Wap/css/base.css">
    <link rel="stylesheet" type="text/css" href="/dzx/Public/Wap/css/wap.css">
    <script type="text/javascript" src="/dzx/Public/Wap/js/jquery.min.js"></script>
</head>
<body>
<div class="header"></div>
<div class="main">
    <div class="main_top">
        <img src="/dzx/Public/Wap/images/dpx.jpg" />
			<span>
				<a href="<?php echo U('index/discern');?>">辨别大闸蟹</a>
				<a href="<?php echo U('index/cooking');?>">大闸蟹做法</a>
				<a href="<?php echo U('index/culture');?>">养殖基地</a>
			</span>
    </div>
    <div class="main_lxpz">
			<span class="lxpz1">
				<img src="/dzx/Public/Wap/images/point3.fw.png">
			</span><span class="lxpz2">
				<img src="/dzx/Public/Wap/images/point1.fw.png">
			</span><span class="lxpz3">
				<img src="/dzx/Public/Wap/images/point2.fw.png">
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
    <div class="pro_list">
        <div class="groom_pro">
            <span>推荐礼盒</span>
        </div>
		<?php if(is_array($com_list)): $i = 0; $__LIST__ = $com_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 商品 -->
			<a href="<?php echo U('product/details?id='.$vo['id']);?>" class="pro_hairy">
				<span class="hairy_left">
					<img src="<?php echo ($vo["image"]); ?>">
				</span>
				<span class="hairy_right">
					<h2><i></i><span>抢鲜价</span><font>￥<?php echo ($vo["tprice"]); ?></font><em></em></h2>
					<u>市场价：￥<?php echo ($vo["price"]); ?></u>
					<b><?php echo ($vo["title"]); ?></b>
					<u class="pro_guige">产品规格</u>
					  <?php echo (get_pro_details($vo["description"])); ?>
				</span>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
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
<script src="/dzx/Public/Wap/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/dzx/Public/Wap/js/layer/layer.js" type="text/javascript"></script>
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