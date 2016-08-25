<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo C('SiteConfig.title');?>|首页</title>
    <meta name="keyword" content="<?php echo C('SiteConfig.keyword');?>" >
    <meta name="description" content="<?php echo C('SiteConfig.description');?>" >
    <link rel="stylesheet" type="text/css" href="/dzx/Public/Home/css/base.css">
    <link rel="stylesheet" type="text/css" href="/dzx/Public/Home/css/index.css">
    <script type="text/javascript" src="/dzx/Public/Home/js/jquery.min-1.7.1.js"></script>
    <script type="text/javascript" src="/dzx/Public/Home/js/tool.js"></script>

    <!-- 联系客服 开始 -->
    <link href="/dzx/Public/Home/css/lrtk.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/dzx/Public/Home/js/lrtk.js"></script>
    <!-- 联系客服 结束 -->

    <!-- 加入购物车 开始 -->
    <style type="text/css">.u-flyer{display: block;width: 100px;height: 100px;border-radius: 50%;position: fixed;z-index: 9999;}</style>
    <script type="text/javascript" src="/dzx/Public/Home/js/fly/jquery.fly.min.js"></script>
    <!-- 加入购物车 结束 -->
    <script type="text/javascript" src="/dzx/Public/Home/js/jquery.cookie.js"></script>
</head>
<body>
<!-- 站头 -->
<div class="header">
    <div class="top">
        <a href="<?php echo U('index/index');?>"><img src="/dzx/Public/Home/images/logo.fw.png" class="top_img img1"></a>
        <img src="/dzx/Public/Home/images/logo2.fw.png" class="top_img img2">
        <img src="/dzx/Public/Home/images/logo3.fw.png" class="top_img img3">
        <img src="/dzx/Public/Home/images/logo4.fw.png" class="top_img img4">
        <span class="tips1"></span>
        <span class="tips2"></span>
        <span class="tips3"></span>
        <a href="<?php echo U('index/index');?>" class="back_home">首页</a>
    </div>
</div>
<link rel="stylesheet" href="/dzx/Public/Home/css/baguettebox.min.css">
<script src="/dzx/Public/Home/js/baguettebox.min.js"></script>
<!-- 主体 -->
<div class="main">
    <!-- 主体左边 -->
    <div class="main_left">
        <!-- 左边上面 -->
        <div class="main_left_top">
				<span class="background_gradient">
					<strong>
                        <b></b>
                        <p>快速送达</p>
                    </strong>
				</span>
				<span class="background_gradient">
					<strong>
                        <b></b>
                        <p>假一赔十</p>
                    </strong>
				</span>
				<span class="background_gradient">
					<strong>
                        <b></b>
                        <p>用心做，诚心做</p>
                    </strong>
				</span>
        </div>
        <!-- 产品 -->
        <div class="main_left_product">
            <!-- 产品导航 -->
            <div class="product_nav">
                <b>推荐礼盒<font class="triangle-right"></font></b>
                <ul class="get_com_list">
<<<<<<< HEAD
                    <li><a href="/" class="fontcolor" data-role="1">全部</a></li>
=======
                    <li><a href="/dzx/" class="fontcolor" data-role="1">全部</a></li>
>>>>>>> 985dab854496a283bac1b5d5179ffd74507e0ef2
                    <?php if(is_array($columns)): $i = 0; $__LIST__ = $columns;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cols): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('index/get_article_list?cid='.$cols['id']);?>"><?php echo ($cols["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--<li><a href="<?php echo U('index/get_article_list?cid=3');?>">小众蟹</a></li>-->
                    <!--<li><a href="<?php echo U('index/get_article_list?cid=4');?>">大众蟹</a></li>-->
                    <!--<li><a href="<?php echo U('index/get_article_list?cid=3');?>">外贸蟹</a></li>-->
                    <!--<li><a href="<?php echo U('index/get_article_list?cid=1');?>">移民蟹</a></li>-->
                </ul>
                <a href="<?php echo U('product/list_dzx');?>">更多</a>
            </div>
            <!-- 产品列表 -->
            <div class="proudct_list">
                <!-- 产品 -->
                <?php if(is_array($com_list)): $i = 0; $__LIST__ = $com_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="product_info">
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
								<b><?php echo ($vo["title"]); ?></b>
								<u>产品规格</u>
                                <?php echo (get_pro_details($vo["description"])); ?>
								<!--<p>4只公蟹2.5-3两</p>-->
								<!--<p>4只母蟹2.0-2.5两</p>-->
							</span>

                            <img src="/dzx/Public/Home/images/zhengpin.fw.png">
                            <a href="<?php echo U('product/details?id='.$vo['id']);?>" class="raisecar">查看详情</a>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
    <!-- 主体右边 -->
    <div class="main_right">
        <!-- 输入优惠券号 -->
        <div class="right_top">
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
        <!-- 红酒专区 -->
        <div class="red_wine">
            <div class="wine_top">
                <b>这个季节螃蟹跟红酒更配哦！</b>
                <a href="<?php echo U('redwine/index');?>">红酒专区</a>
            </div>
            <!-- 红酒列表 -->
            <div class="wine_list">
                <?php if(is_array($get_redwine_list)): $i = 0; $__LIST__ = $get_redwine_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rw): $mod = ($i % 2 );++$i;?><a href="<?php echo U('product/details?id='.$rw['id']);?>" title="<?php echo ($rw["title"]); ?>">
                        <img src="<?php echo ($rw["image"]); ?>">
                        <strong>
                            <b></b>
                            <em>￥<?php echo ($rw["tprice"]); ?></em>
                        </strong>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <!-- 辨别大闸蟹 -->
        <div class="right_check">
            <b class="check1">大闸蟹辨别</b>
            <div class="check_content">
                <p>阳澄湖大闸蟹近年来越来越少，不光是国内要吃、香港台湾要吃，海外的华人更是要买
                    来解解馋嘴。好多团购网站都打着好低好低的折扣，举着阳澄湖大闸蟹的牌子，那么，
                    您买到的，到底是很划算的抄底价阳澄湖大闸蟹还是去洗了个澡的洗澡蟹呢？</p>
					<span>
						<b>最简单最传统的方法就是看外形辨别阳澄湖大闸蟹的真伪</b>
						<strong>
                            <em>
                                <a><img src="/dzx/Public/Home/images/chek1.fw.png"></a>
                                <i>青背</i>
                            </em><em>
                            <a><img src="/dzx/Public/Home/images/chek2.fw.png"></a>
                            <i>白肚</i>
                        </em><em>
                            <a><img src="/dzx/Public/Home/images/chek3.fw.png"></a>
                            <i>黄毛</i>
                        </em><em style="margin-right:0;">
                            <a><img src="/dzx/Public/Home/images/chek4.fw.png"></a>
                            <i>金爪</i>
                        </em>
                        </strong>
					</span>
            </div>
            <div class="clear"></div>
        </div>
        <!-- 大闸蟹做法 -->
        <div class="right_check">
            <b class="check2">大闸蟹做法</b>
            <div class="check_content">
                <a><img src="/dzx/Public/Home/images/dpx.jpg"></a>
                <p class="cdzx">每当到了金秋十月，就是吃螃蟹的好季节，这个季节
                    的螃蟹肉肥膏多，正是味道鲜美的时候，那么很多人
                    想吃螃蟹，尤其是比较出名的阳澄湖大闸蟹，但是却
                    不知道该怎么吃？更不知道吃螃蟹的一些技巧和禁忌
                    今天向上君就为大家带来清蒸大闸蟹的做法，希望能
                    够帮助到您。</p>
                <div class="dzx_cdff">
                    <ol>
                        <strong>
                            <li>把买来的大闸蟹放到水里面约1个小时，可以让螃蟹吐出身体里的脏东西</li>
                        </strong>
                        <strong>
                            <li>取蒸锅，开火，锅中放入适量的凉水，然后把螃蟹放于锅内，最好是把
                                螃蟹肚子朝上放置，这样膏就不会流走</li>
                        </strong>
                        <strong>
                            <li>然后在螃蟹的身上撒上生姜和大蒜，或者可以用紫薯，都能够去腥杀毒</li>
                        </strong>
                        <strong>
                            <li>放好大蒜生姜后，就开火烧水，把盖子盖上</li>
                        </strong>
                        <strong>
                            <li>螃蟹要蒸大约15到20分钟，建议蒸够20分钟，这样吃起来肉好吃更健康</li>
                        </strong>
                        <strong>
                            <li>把螃蟹从锅里取出，然后就可以开始享受美味了</li>
                        </strong>
                        <strong>
                            <li>吃螃蟹要配上陈醋和大蒜生姜，在大蒜生姜沫里加入陈醋，形成调料</li>
                        </strong>
                    </ol>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- 养殖基地 -->
        <div class="right_check">
            <b class="check3">我们的养殖基地</b>
            <div class="baguetteBoxOne gallery yzjd_pic">
                <a href="/dzx/Public/Home/images/yzjd1.jpg" data-caption="Golden Gate Bridge"><img src="/dzx/Public/Home/images/yzjd1_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd2.jpg" title="Midnight City"><img src="/dzx/Public/Home/images/yzjd2_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd3.jpg"><img src="/dzx/Public/Home/images/yzjd3_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd4.jpg"><img src="/dzx/Public/Home/images/yzjd4_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd5.jpg"><img src="/dzx/Public/Home/images/yzjd5_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd6.jpg"><img src="/dzx/Public/Home/images/yzjd6_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd7.jpg"><img src="/dzx/Public/Home/images/yzjd7_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd8.jpg"><img src="/dzx/Public/Home/images/yzjd8_s.jpg" /></a>
                <a href="/dzx/Public/Home/images/yzjd9.jpg"><img src="/dzx/Public/Home/images/yzjd9_s.jpg" /></a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script type="text/javascript">
    $(function(){
        // 查看图片
        baguetteBox.run('.baguetteBoxOne', {
            animation: 'fadeIn'
        });
        $('.get_com_list>li>a').click(function (e) {
            e.preventDefault();
            if($(this).attr('data-role')==1){
                window.location.reload();
            }
            $(this).addClass('fontcolor');
            $(this).parent().siblings().find('a').removeClass('fontcolor');
            $url = $(this).attr('href');
            $.get($url,function (data) {
                if(data.status==1){
                    $('.proudct_list').empty().html(data.list);
                }
            });
        });
    });
</script>
<!-- 站尾 -->
<div class="footer">
    <address>Copyright©2005-2015,Suxiege Co.,Ltd. All right reserved. 所有内容均由阳澄湖大闸蟹制作，未经许可不得转载</address>
    <i>经营许可证编号: 沪ICP备15028124号</i>
    <b>味道鲜美正是食蟹的大好时节</b>
    <img src="/dzx/Public/Home/images/logo.fw.png">
</div>
<script type="text/javascript" src="/dzx/Public/Plug/layer-v2.2/layer/layer.min.js"></script>
<!-- 联系客服 -->
<div id="top">
    <div id="izl_rmenu" class="izl-rmenu">
        <a href="#" id="end" class="btn btn-gwc"></a>
        <a href="tencent://Message/?Uin=123456789&websiteName=www.lanrentuku.com=&Menu=yes" class="btn btn-qq"></a>
        <div class="btn btn-wx">
            <img class="pic" src="/dzx/Public/Home/images/weixin.jpg" onclick="window.location.href='http://www.lanrentuku.com'"/>
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
<script src="/dzx/Public/Home/js/baguettebox.min.js" type="text/javascript"></script>
<script src="/dzx/Public/Home/js/jquery.cookie.js" type="text/javascript"></script>
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
            $addcar = $(this);
            $type = $addcar.attr('data-type');

            //写入购物车操作
            $id = $addcar.attr('data-id');
            $sum = $addcar.attr('data-sum');

            $.post('<?php echo U("product/check_pro");?>',{t:$type,id:$id},function (data) {
                if(data.status==0){
                    layer.alert(data.msg,{icon:2});
                }
            });

            //飞入购物车效果
            if($type!='coupon'){
                $image = $addcar.parent('div.product_price').siblings('strong.product_img');
                var flyer = $('<img class="u-flyer" src="'+$image.find('img').attr('src')+'">');
            }else {
                var flyer = $('<img class="u-flyer" src="/dzx/Public/Home/images/couponaddcar.jpg">');
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