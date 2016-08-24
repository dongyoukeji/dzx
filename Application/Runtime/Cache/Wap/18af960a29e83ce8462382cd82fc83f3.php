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
        <a href="<?php echo U('index/discern');?>" >辨别大闸蟹</a>
        <a href="<?php echo U('index/cooking');?>" id="active">大闸蟹做法</a>
        <a href="<?php echo U('index/culture');?>" style="border-right: none;">养殖基地</a>
    </div>
    <div class="dzx_dis_fun">
        <p>每当到了金秋十月，就是吃螃蟹的好季节，这个季节 的螃蟹肉肥膏多，正是味道鲜美的时候，那么很多人 想吃螃蟹，尤其是比较出名的阳澄湖大闸蟹，但是却 不知道该怎么吃？更不知道吃螃蟹的一些技巧和禁忌 今天向上君就为大家带来清蒸大闸蟹的做法，希望能 够帮助到您。</p>
        <img src="/Public/Wap/images/dzx5.jpg">
        <ol>
            <li>1.&nbsp;&nbsp;把买来的大闸蟹放到水里面约1个小时，可以让螃蟹吐出身体里的脏东西</li>
            <li>2.&nbsp;&nbsp;取蒸锅，开火，锅中放入适量的凉水，然后把螃蟹放于锅内，最好是把 螃蟹肚子朝上放置，这样膏就不会流走</li>
            <li>3.&nbsp;&nbsp;然后在螃蟹的身上撒上生姜和大蒜，或者可以用紫薯，都能够去腥杀毒</li>
            <li>4.&nbsp;&nbsp;放好大蒜生姜后，就开火烧水，把盖子盖上</li>
            <li>5.&nbsp;&nbsp;螃蟹要蒸大约15到20分钟，建议蒸够20分钟，这样吃起来肉好吃更健康</li>
            <li>6.&nbsp;&nbsp;把螃蟹从锅里取出，然后就可以开始享受美味了</li>
            <li>7.&nbsp;&nbsp;吃螃蟹要配上陈醋和大蒜生姜，在大蒜生姜沫里加入陈醋，形成调料</li>
        </ol>
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