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
<!-- 主体 -->
<div class="main">
    <div class="cart_title">
        <h3>我的购物车</h3>
        <a onclick="clearItem()">清空购物车</a>
    </div>
	<form action="<?php echo U('oder/pay_for');?>" method="post" autocomplete="off">
		<!-- 购物列表 -->
		<div class="cart_pro_list">
			<!-- 购买的商品 -->
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="cart_product car_check" data-index='<?php if(($vo1["type"]) == "1"): ?>goods<?php endif; if(($vo1["type"]) == "2"): ?>wine<?php endif; if(($vo1["type"]) == "3"): ?>coupon<?php endif; ?>_<?php echo ($vo1["id"]); ?>'>
						<span class="cart_pro_left">
							<input type="checkbox"  onclick="inpCheck(this)" checked />
							<!-- <label for="product2"></label> -->
							<b><img src="<?php echo ($vo1["image"]); ?>"></b>
							<strong>
								<a><?php echo ($vo1["title"]); if(($vo1["type"]) == "2"): ?><span class="orange_bg">红酒</span><?php endif; if(($vo1["type"]) == "1"): ?><span class="blue_bg">礼盒</span><?php endif; if(($vo1["type"]) == "3"): ?><span class="claret_red_bg">礼品券</span><?php endif; ?> </a>
								<i>优质阳澄湖大闸蟹不一样的螃蟹</i>
								<em><?php echo (get_pro_left($vo1["description"])); if(($vo1["type"]) != "2"): ?><font>&nbsp;&nbsp;|&nbsp;&nbsp;</font><?php echo (get_pro_right($vo1["description"])); endif; ?>
								</em>
								<?php if(($vo1["type"]) == "2"): ?><div class="wine_check">
							<input type="checkbox" id="bzhxz<?php echo ($key); ?>" class="bzhxz" data-key="<?php echo ($key); ?>" onclick="showBox(this)" />
							<label for="bzhxz<?php echo ($key); ?>">
								<span>选择红酒包装</span><u id="wine_pic<?php echo ($key); ?>" data-key="<?php echo ($key); ?>"><small></small></u>
							</label>
						</div><?php endif; if(($vo1["type"]) == "1"): ?><div><img src="/Public/Home/images/zhengpin.fw.png"></div><?php endif; if(($vo1["type"]) == "3"): endif; ?>
							</strong>
						</span>
						<span class="cart_pro_right">
							<strong>
								<input type="button" name="minus" value="-" class="jiajian minus" onclick="doMinus(this,<?php echo ($vo1["tprice"]); ?>)">
								<input type="text" name="num[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["get_num"]); ?>" class="number" onkeyup="change_sum(this,<?php echo ($vo1["tprice"]); ?>)">
								<input type="button" name="plus" value="+" class="jiajian plus"  onclick="doPlus(this,<?php echo ($vo1["tprice"]); ?>)">
								<input type="hidden" name="mass[<?php echo ($vo1["tt"]); ?>][]" class="mass" value="<?php echo ($vo1["mass"]); ?>" data-fufei='<?php if(($vo1["type"]) == "1"): ?>1<?php endif; if(($vo1["type"]) == "2"): ?>0<?php endif; if(($vo1["type"]) == "3"): ?>0<?php endif; ?>'>
								<input type="hidden" name="price[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["tprice"]); ?>">
								<input type="hidden" name="id[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["id"]); ?>">
							</strong>
							<h2>￥<i class="single_price"><?php echo ($vo1["tprice"]); ?></i><span>元</span></h2>
						</span>
						<span class="cart_delect" onclick="delItem(this)" ><i>×</i></span>
						<?php if(($vo1["type"]) == "2"): ?><div class="clear"></div>
							<div class="wine_box" data-key="<?php echo ($key); ?>">
								<ul >
									<?php if(is_array($boxes)): $k = 0; $__LIST__ = $boxes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k % 2 );++$k;?><li data-key="<?php echo ($key); ?>">
											<span>￥<?php echo ($vo2["tprice"]); ?><input type="number" name="box_num[<?php echo ($vo1["tt"]); ?>_<?php echo ($vo1["id"]); ?>_<?php echo ($vo2["id"]); ?>][]" value="1" class="wine_box_num" data-price="<?php echo ($vo2["tprice"]); ?>" /></span>
											<input type="checkbox" value="1" name="box_num_selected[<?php echo ($vo1["tt"]); ?>_<?php echo ($vo1["id"]); ?>_<?php echo ($vo2["id"]); ?>][]"  id="thbzh<?php echo ($vo1["id"]); echo ($key); ?>1" class="thbzh thbzh<?php echo ($key); ?>" data-key="<?php echo ($key); ?>" onclick="showBoxPic(this)" />
											<label for="thbzh<?php echo ($vo1["id"]); echo ($key); ?>1"><img src="<?php echo ($vo2["image"]); ?>"></label>
											<em><?php echo ($vo2["title"]); ?></em>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div><?php endif; ?>
					</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<!-- 用户信息 -->
		<div class="user_info">
			<span class="details_info user_left">
				<i></i>
				<h5>购买人信息</h5>
				<span>
					<em>姓名</em><input type="text" name="suser" id="suser"/>
				</span>
				<span>
					<em>手机号</em><input type="text" name="sphone" id="sphone" />
				</span>
			</span>
			<span class="details_info user_right">
				<h5>收货人信息</h5>
				<span>
					<em>姓名</em><input type="text" name="huser" id="huser" />
				</span>
				<span class="width width1">
					<em>省份/市区</em><input type="text" name="city" id="city" readonly="readonly" value="江苏省-苏州市-姑苏区" />
				</span>
				<span>
					<em>手机号</em><input type="text" name="hphone" id="hphone"/>
				</span>
				<span class="width width2">
					<em>收货地址</em><input type="text" name="street" id="street" />
				</span>
			</span>
		</div>
		<div class="clear"></div>

		<label id="express_price" style="display:none;">20</label>
		<label id="express_overweight" style="display:none;">2</label>
		<label id="express_kg" style="display:none;"><?php echo ($kg); ?></label>

		<!-- 支付信息 -->
		<div class="cart_pay">
			<strong>顺丰/<font id="shunfeng">￥<?php echo ($mass_totals); ?></font>元<label><input type="checkbox"  onclick="plushEMS(this)" value="1" name="shunfeng_ems" class="shunfeng_ems">到付</label></strong>
			<!--<div>-->
				<!--顺丰快递礼盒附加费用: <span id="mass_totals">￥<?php echo ($mass_totals); ?></span>-->
			<!--</div>-->
			<span>
				<strong>
					<em>共 <font id="pro_sum"><?php echo ($nums); ?></font> 件商品</em>
					<i>￥<i id="totals_price"><?php echo ($totals); ?></i><font>元</font></i>
					<input type="hidden" name="totals_price" value="<?php echo ($totals); ?>" id="totals_price1">
				</strong>
				<div class="clear"></div>
				<span>
					支付成功后，您将收到订单编号，可随时登录官方查看物流信息
					<input type="submit" id="qrzf" value="确认支付">
				</span>
				<div class="clear"></div>
				<i>如未收到短信息请联系客服</i>
			</span>
		</div>
	</form>
    <div class="clear"></div>
</div>
<!-- 选中地区 开始 -->
<link rel="stylesheet" type="text/css" href="/Public/Home/js/city/city.css">
<script src="/Public/Home/js/city/Popt.js"></script>
<script src="/Public/Home/js/city/cityJson.js"></script>
<script src="/Public/Home/js/city/citySet.js"></script>
<!-- 选中地区 结束 -->
<script type="text/javascript">
	$(function(){
		clearCookie();
		$('.wine_box_num').change(function () {
			get_boxes_price($(this));
			get_all_price();
		});	
		$('.thbzh').click(function () {
			get_boxes_price_by_images($(this));
			get_all_price();
		});
		// 选中地区
		$("#city").click(function (e) {
			SelCity(this,e);
		});
		// 送礼收礼
		$('#suser').keyup(function(event) {
			/* Act on the event */
			$('#huser').val($(this).val());
		});
		$('#sphone').keyup(function(){
			$('#hphone').val($(this).val());
		});
		// 提交
		$('#qrzf').click(function(e){
			e.preventDefault();
			// 姓名
			if($('#suser').val() == ""){
				$('#suser').parent().addClass("error");
				return false;
			}else{
				$('#suser').parent().removeClass("error");
			}
			// 手机号
			if($('#sphone').val() == "" || !phoneReg.test($('#sphone').val())){
				$('#sphone').parent().addClass("error");
				return false;
			}else{
				$('#sphone').parent().removeClass("error");
			}
			// 手机号
			if($('#hphone').val() == "" || !phoneReg.test($('#hphone').val())){
				$('#hphone').parent().addClass("error");
				return false;
			}else{
				$('#hphone').parent().removeClass("error");
			}
			// 省份
			if($('#city').val() == ""){
				$('#city').parent().addClass("error");
				return false;
			}else{
				$('#city').parent().removeClass("error");
			}
			// 街道
			if($('#street').val() == ""){
				$('#street').parent().addClass("error");
				return false;
			}else{
				$('#street').parent().removeClass("error");
			}

			$form = $('form');
			//layer.load(2, {
			//	shade: [0.3,'#000'] //0.1透明度的白色背景
			//});

			var json = $form.serialize();



			$.post($form.attr('action'),$form.serialize(),function (data) {
				if(data.status==1){
					layer.closeAll('loading');
					clearCookie();
					//询问框
					layer.confirm(data.msg, {
						btn: ['我选好了现在支付','不买了我没有想好'] //按钮
					}, function(){
						layer.closeAll();
						layer.open({
							type: 2,
							area: ['1024px', '850px'],
							fix: false, //不固定
							maxmin: true,
							content: data.redirect
						});
					}, function(){
						$.post('<?php echo U("oder/cancel");?>',{id:data.order_id},function (data) {
							if(data.status==1){
								window.location.href=data.redirect;
							}else {
								layer.alert(data.msg,{icon:2});
							}
						});
					});
				}
			});
		});
		$('input[type="text"]').focus(function(){
			$(this).parent().removeClass('error');
		});

		// 显示红酒包装盒价格
		// $('.thbzh').click(function(){
		// 	var key = $(this).attr('data-key');
		// 	var size = $('.thbzh'+key+':checked').length;
		// 	if($('.thbzh'+key).is(':checked')){
		// 		// $('#wine_pic'+key).html('<small>￥<font>30.00</font>元</small>');
		// 		$('#wine_pic'+key +' small').show();
		// 	}else{
		// 		if(size==0){
		// 			$('#wine_pic'+key+' small').hide();
		// 		}
		// 	}
		// });

		// 红酒包装盒数量至少为1
		$('.wine_box_num').change(function(){
			if($(this).val() < 1){
				$(this).val(1) ;
			}
		});
	});
	// 购物车商品选中状态
	function inpCheck(obj){
		$obj =$(obj);
		if($obj.is(':checked')){
			$obj.parent().parent().attr('class','cart_product car_check');
		}else{
			$obj.parent().parent().attr('class','cart_product car_uncheck');
			//$('#wine_pic'+$key).find('small').empty().hide();
		}
		get_all_price();
		//$('#totals_price').text(get_all_price());
	}

	$price = $('.single_price').text();
	// 商品数量的加减
	function doMinus(obj,p){
		$obj = $(obj);

		var num = $obj.next().val();
		--num;
		if(num < 1){
			$obj.removeAttr('onclick');
			num=1;
		}
		$obj.next().val(num);
		get_all_price();
		//$tt = get_orther_price($obj,num);
		//alert($tt);
		//$('#totals_price').text(get_all_price());
		//$('#totals_price1').val($tt);
		//get_ems_price();
		//$('#pro_sum').text(num);
	}
	function doPlus(obj,p){
		$obj = $(obj);
		var num = $obj.prev().val();
		if(num==1){
			$('.minus').live('click',function(){
				doMinus(this);
			});
		}
		++num;
		if(num < 0)
			num = 1;
		$obj.prev().val(num);
		get_all_price();
		//$tt = get_orther_price($obj,num);
		//$('#totals_price').text(get_all_price());

		//get_ems_price();
		//$('#pro_sum').text(num);
	}

	var phoneReg = /^1[3|4|5|7|8]\d{9}$/;
	// 手机验证
	function checkPhone(obj){
		$obj = $(obj);
		var val = $obj.val();
		if(!phoneReg.test(val)){
			$obj.parent().addClass("error");
		}else{
			$obj.parent().removeClass("error");
		}
	}
	function change_sum(obj,p) {
		$obj = $(obj);
		$sum = $obj.val();
		if($sum==''){
			$sum=1;
		}
		$tt= get_all_price($obj);
		$('#totals_price').text($tt);
		//$('#pro_sum').text($sum);
	}
	/**
	 * 获取除去自己外其他的价格
	 * @param obj
	 * @returns {number}
     */
	function get_orther_price(obj,num) {
		$prices =0;
		$sf =0;
		$p = obj.parent().parent().parent();
		$('.cart_product').each(function () {
			if($(this).index()!=$p.attr('data-index')){
				if($(this).children('span.cart_pro_left').children('input[type="checkbox"]').is(':checked')){
					$price = $(this).children('span.cart_pro_right').children('h2').children('i.single_price').text();
					$sum = $(this).children('span.cart_pro_right').children('strong').children('input[type="text"]').val();
					$sf += parseInt($sum);
					$prices += parseInt($price)*parseInt($sum);
				}
			}
		});
		$sm = get_ems_price();

		if($('.shunfeng_ems').is(':checked')){
			$sm=0;
		}
		$('#pro_sum').text($sf);
		$('#totals_price1').val($prices + $sm);
		return $prices + $sm;
	}
	/**
	 * 获取所有的价格
	 * @returns {number}
	 */
	function get_all_price() {
		$prices =0;
		$sf=0;
		$('.cart_product').each(function () {
			if($(this).children('span.cart_pro_left').children('input[type="checkbox"]').is(':checked')){
				$price = $(this).children('span.cart_pro_right').children('h2').children('i.single_price').text();
				$sum = $(this).children('span.cart_pro_right').children('strong').children('input[type="text"]').val();
				$ll =parseInt($price)*parseInt($sum);
				$prices +=$ll;
				$sf += parseInt($sum);
			}
		});
		$('#pro_sum').text($sf);
		if($sf=='0'){
			return 0;
		}
		//盒子价格
		$pp = get_boxes_totals();
		
		//邮费价格
		$tt= get_ems_price();
		if($('.shunfeng_ems').is(':checked')){
			$tt=0;
		}
		$pry =$prices + $tt + $pp;
		$('#totals_price1').val($pry);
		$('#totals_price').text($pry);
		
		return $pry;
	}
	/**
	 * 删除项
	 * @param obj
     */
	function delItem(obj) {
		$obj = $(obj).parent();
		layer.confirm('您确定要删除吗？删除后您将不能找回商品', {
			btn: ['确定','取消'] //按钮
		}, function(){
			clearCookie();
			$.post('/Home/Product/delItem',{i:$obj.attr('data-index')},function (data) {
				if(data.status=1){
					layer.closeAll();
					$obj.remove();
					$('#totals_price').text(get_all_price());
					window.location.reload();
				}
			});
		});

	}
	function clearItem() {
		layer.confirm('您确定要清除购物车吗？清除后您将不能找回商品', {
			btn: ['确定','取消'] //按钮
		}, function(){
			clearCookie();
			$.get('/Home/Product/delItems',function (data) {
				if(data.status==1){
					layer.closeAll();
					$('.cart_pro_list').empty();
					$('#totals_price').text(get_all_price());
					window.location.reload();
				}
			});
		});
	}

	function plushEMS(obj) {
		$('#totals_price').text(get_all_price());
	}

	function get_ems_price() {
		$mass=0;
		$tal=0;
		$kg = 0;
		$('.cart_product').each(function () {
			if($(this).children('span.cart_pro_left').children('input[type="checkbox"]').is(':checked')){
				$number = $(this).children('span.cart_pro_right').children('strong').children('input.number').val();
				$input = $(this).children('span.cart_pro_right').children('strong').children('input.mass');
				if($input.attr('data-fufei')==1){
					if($input.val()!=''){
						$mass = parseFloat($input.val());
						$kg +=$mass*$number;
					}
				}
			}
		});
		if($kg>0){
			$price = $('#express_price').text();
			$overweight = $('#express_overweight').text();
			$tal = overweight1(parseFloat($price),parseFloat($overweight),parseFloat($kg));
		}
		if($tal!=NaN){
			$('#shunfeng').text("￥"+$tal);
			return parseFloat($tal);
		}else {
			return 0;
		}
	}

	function overweight1(p,p1,h) {
		if(h<=1){
			return p;
		}else{
			return p+(h-1)*p1;
		}
	}

	// 显示红酒包装盒
	function showBox(obj){
		$obj = $(obj);
		var key = $obj.attr('data-key');
		if($obj.is(':checked')){
			if($('.thbzh'+key).is(':checked')){
				$obj.next().children('u').children('small').show();
			}
			$obj.parent().parent().parent().siblings('div.wine_box').show();
		}else{
			$obj.next().children('u').children('small').hide();
			$obj.parent().parent().parent().siblings('div.wine_box').hide();
		}
	}

	// 显示红酒包装盒价格
	function showBoxPic(obj) {
		$obj = $(obj);
		var sPosition = $obj.parent('li').parent('ul').parent('div.wine_box').siblings('span.cart_pro_left').children('strong').children('div.wine_check').children('label').children('u').children('small');
		if ($obj.is(":checked")) {
			sPosition.show();
		}else{
			if(($obj+':checked').length==0)
				sPosition.hide();
		}
	}


	/**
	 * 获取价格
	 * @returns {number}
     */
	function get_boxes_totals() {
		$boxes_totals=0;
		$boxes_price=0;
		
		var reg = /[1-9][0-9]*/g;
		
		$('.wine_check').each(function(){
			$ckeckbox = $(this).children('input.bzhxz');
			$ckeckbox1 = $(this).parent('strong').siblings('input[type="checkbox"]');
			var pric = $(this).children('label').children('u').find('small').text();
			if($ckeckbox1.is(':checked')){
				if($ckeckbox.is(':checked')){
					
					if(pric!=''){
						pric = pric.match(reg);
						$boxes_totals += parseFloat(pric);
					}
				}	
			}else{
				$boxes_totals -= 0;
				// if(pric!=''){
				// 	pric = pric.match(reg);
				// 	$boxes_totals1 += parseFloat(pric);
				// }		
			}
		});
		
		// $tp = <?php echo ($totals); ?>;		
		
		// if($boxes_totals!=0){
		// 	$tp = parseFloat($tp)+$boxes_totals;
		// }
		// $('#totals_price').text($tp);
		$boxes_totals = $boxes_totals;
		return $boxes_totals;
	}
	/**
	 * 获取单条总数
	 * @param obj
	 * @returns {number}
     */
	function get_boxes_price(obj) {
		$boxes_price=0;
		$element = obj.parent('span').parent('li').parent('ul').parent('div.wine_box');
		$key = $element.attr('data-key');
		$('.wine_box').each(function () {
			if($(this).attr('data-key')==$key){
				$(this).find('ul>li').each(function () {
					if($(this).find('input[type="checkbox"]').is(':checked')){	//选中盒子
						$element=$(this).find('input.wine_box_num');
						$num = $element.val();
						$num = ($num<=0)?1:$num;
						$price = $element.attr('data-price');
						$boxes_price +=$num*$price;
					}
				});
			}
		});
		if($boxes_price>0){
			$('#wine_pic'+$key).find('small').text('￥'+$boxes_price+"元");
		}else {
			$('#wine_pic'+$key).find('small').hide();
		}
		$tp = <?php echo ($totals); ?>;
		if($boxes_price>0){
			$tp = parseFloat($tp)+$boxes_price;
		}
		//$('#totals_price').text($tp);

		return $boxes_price;
	}

	/**
	 * 点击image获取单价
	 * @param obj
	 * @returns {number}
     */
	function get_boxes_price_by_images(obj) {
		$boxes_price=0;
		// $element = obj.parent('li');
		$element = obj.parent('li').parent('ul').parent('div.wine_box');
		$key = $element.attr('data-key');
		$('.wine_box').each(function () {
			if($(this).attr('data-key')==$key){
				$(this).find('ul>li').each(function () {
					if($(this).find('input[type="checkbox"]').is(':checked')){	//选中盒子
						$element=$(this).find('input.wine_box_num');
						$num = $element.val();
						$num = ($num<=0)?1:$num;
						$price = $element.attr('data-price');
						$boxes_price +=$num*$price;
					}
				});
			}
		});
		if($boxes_price!=0){
			$('#wine_pic'+$key).find('small').text('￥'+$boxes_price+"元");
		}else {
			$('#wine_pic'+$key).find('small').empty().hide();
		}
		return $boxes_price;
	}
</script>
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