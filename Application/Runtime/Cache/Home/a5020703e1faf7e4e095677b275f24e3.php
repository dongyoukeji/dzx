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
<!-- 主体 -->
<div class="main" style="margin-top: 50px;">
    <div class="main_left" style="border:none;">
        <div class="ticket">
				<span class="ticket_top">
					<a href="javascript:void(0);" class="current" id="current">领取礼盒</a><a href="javascript:void(0);" id="logistics">
                    查询订单状态</a>
                    <!-- <b class="xtips1"><font></font><i>礼品券换礼盒</i></b> -->
				</span>
            <!-- 礼品券 -->
				<span id="ticket_edit" class="ticket_edit ticket1">
					<input type="text" name="ticket_code" class="ticket_code" placeholder="请输入礼品券编号" />
					<input type="button" name="fetch" class="fetch" value="领取" />
				</span>
        </div>
    </div>
    <div class="main_right">
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
    <div class="cart_title">
        <h3>我的订单<font><?php echo ($vo["ordid"]); ?></font></h3>
        <a>下单日期<font><?php echo (date('Y-m-d h:s',$vo["ordtime"])); ?></font></a>
    </div>
    <!-- 购物列表 -->
    <div class="cart_pro_list">
        <!-- 购买的商品 -->
        <?php if(is_array($vo["pro"])): $i = 0; $__LIST__ = $vo["pro"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="cart_product car_uncheck">
				<span class="cart_pro_left">
					<b><img src="<?php echo ($vo1["image"]); ?>"></b>
					<strong>
                        <a><?php echo ($vo1["title"]); ?><span class="orange_bg">礼盒</span></a>
                        <i>优质阳澄湖大闸蟹不一样的螃蟹</i>
                        <em>4只公蟹2.5-3两<font>&nbsp;&nbsp;|&nbsp;&nbsp;</font>4只母蟹2.0-2.5两
                        </em>
                        <img src="/Public/Home/images/zhengpin.fw.png">
                    </strong>
				</span>
				<span class="cart_pro_right">
					<strong>
                        <input type="button" name="minus" value="-" class="jiajian minus" disabled>
                        <input type="text" name="num" value="<?php echo ($vo1["count"]); ?>" class="number" disabled>
                        <input type="button" name="plus" value="+" class="jiajian plus" disabled>
                    </strong>
					<h2><?php echo ($vo1["totals"]); ?><span>元</span></h2>
				</span>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 用户信息 -->
    <div class="user_info">
			<span class="details_info user_left">
				<i></i>
				<h5>购买人信息</h5>
				<span>
					<em>姓名</em><input type="text" name="username" value="<?php echo ($vo["username"]); ?>"  disabled/>
				</span>
				<span>
					<em>手机号</em><input type="tel" value="<?php echo ($vo["phone"]); ?>" name="phone" disabled/>
				</span>
			</span>
			<span class="details_info user_right">
				<h5>收货人信息</h5>
				<span>
					<em>姓名</em><input type="text" name="username" value="<?php echo (get_info_left($vo["post_userinfo"])); ?>" disabled/>
				</span>
				<span class="width width1">
					<em>省份/市区</em><input type="text" name="phone" id="city" value="<?php echo (get_address_left($vo["post_address"])); ?>" disabled/>
				</span>
				<span>
					<em>手机号</em><input type="tel" name="phone" value="<?php echo (get_info_right($vo["post_userinfo"])); ?>" disabled/>
				</span>
				<span class="width width2">
					<em>收货地址</em><input type="text" name="phone" value="<?php echo (get_address_right($vo["post_address"])); ?>" disabled/>
				</span>
			</span>
    </div>
    <!-- 物流信息 -->
    <div class="logistics_info">
        <h4>因红酒无法空运，我们将双向发货！请注意查收您购买的商品，如有任何问题请联系在线客服</h4>
        <div class="logistics_info_list">
				<span>
					<strong class="logistics_info_title1">
                        <b>物流信息</b>
                        <i class="claret_red_bg">商品</i>
                    </strong>
					<strong class="logistics_pay logistics_info_title2">顺丰单号/<font><?php echo ($vo["post_goods_express"]); ?></font><label><input type="checkbox" <?php if(($vo["shun_feng"]) == "0"): ?>checked<?php endif; ?> disabled> <?php if(($vo["shun_feng"]) == "1"): ?>到付<?php else: ?>已付<?php endif; ?></label></strong>
				</span>
            <div class="clear"></div>
            <div class="logistics_addr"></div>
        </div><div class="logistics_info_list">
				<span>
					<strong class="logistics_info_title1">
                        <b>物流信息</b>
                        <i class="orange_bg">红酒</i>
                    </strong>
					<strong class="logistics_pay logistics_info_title2">顺丰单号/<font><?php echo ($vo["post_wine_express"]); ?></font><label><input type="checkbox" checked disabled>已付</label></strong>
				</span>
        <div class="clear"></div>
        <div class="logistics_addr"></div>
    </div>
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