<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/base.css">
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/wap.css">
    <script type="text/javascript" src="/Public/Wap/js/jquery.min.js"></script>
</head>
<body>
<div class="header">
    <a href="<?php echo U('index/index');?>" class="home"><img src="/Public/Wap/images/home.fw.png" /></a>
</div>
<div class="main">
    <div class="dzx_nav">
        <a href="<?php echo U('index/discern');?>" id="active">辨别大闸蟹</a>
        <a href="<?php echo U('index/cooking');?>">大闸蟹做法</a>
        <a href="<?php echo U('index/culture');?>" style="border-right: none;">养殖基地</a>
    </div>
    <div class="dzx_dis_fun">
        <p>阳澄湖大闸蟹近年来越来越少，不光是国内要吃、香港台湾要吃，海外的华人更是要买 来解解馋嘴。好多团购网站都打着好低好低的折扣，举着阳澄湖大闸蟹的牌子，那么， 您买到的，到底是很划算的抄底价阳澄湖大闸蟹还是去洗了个澡的洗澡蟹呢？</p>
			<span>
				<em>
                    <b><img src="/Public/Wap/images/dax1.jpg"></b>
                    <i>青背</i>
                </em><em>
                <b><img src="/Public/Wap/images/dax2.jpg"></b>
                <i>白肚</i>
            </em><em>
                <b><img src="/Public/Wap/images/dax3.jpg"></b>
                <i>黄毛</i>
            </em><em>
                <b><img src="/Public/Wap/images/dax4.jpg"></b>
                <i>金爪</i>
            </em>
			</span>
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
            console.log($.cookie());

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