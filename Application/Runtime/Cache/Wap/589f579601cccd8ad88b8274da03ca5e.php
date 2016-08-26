<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/base.css">
    <link rel="stylesheet" type="text/css" href="/Public/Wap/css/wap.css">
    <!-- 选中地区 开始 -->
    <link rel="stylesheet" type="text/css" href="/Public/Wap/js/city/LArea.css">
    <script type="text/javascript" src="/Public/Wap/js/jquery.min.js"></script>
    <script src="/Public/Wap/js/city/LArea.js"></script>
    <script src="/Public/Wap/js/city/LAreaData1.js"></script>
    <script src="/Public/Wap/js/city/LAreaData2.js"></script>
    <!-- 选中地区 结束 -->
</head>
<body>
<div class="header">
    <a href="index.html" class="home"><img src="/Public/Wap/images/home.fw.png" /></a>
</div>
<div class="main padd">
    <form action="<?php echo U('oder/pay_for');?>" method="post" autocomplete="off">
        <div class="cart_title">
            <b>我的购物车，共<font class="red_col">2</font>件商品</b>
            <a class="gray_col" onclick="clearItem()">清除</a>
        </div>
        <!-- 商品列表 -->
        <div class="cart_pro_list">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 商品 -->
                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="cart_product cart_check" data-index="<?php echo ($vo1["tt"]); ?>">
                        <label onclick="inpCheck(this)">
                            <input type="checkbox" checked/>
                            <b><img src="<?php echo ($vo1["image"]); ?>"></b>
                        </label>
                        <span>
                            <h3><?php echo ($vo1["title"]); ?></h3>
                            <p class="gray_col2"><?php echo (get_pro_left($vo1["description"])); ?></p>
                            <p class="gray_col2"><?php echo (get_pro_right($vo1["description"])); ?></p>
                            <strong>
                                <input type="button" name="minus" value="-" class="jiajian minus" onclick="doMinus(this,<?php echo ($vo1["tprice"]); ?>)" />
                                <input type="number" name="num[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["get_num"]); ?>" class="number" onkeyup="change_sum(this,<?php echo ($vo1["tprice"]); ?>)">
                                <input type="button" name="plus" value="+" class="jiajian plus" onclick="doPlus(this,<?php echo ($vo1["tprice"]); ?>)" />
                                <input type="hidden" name="mass[<?php echo ($vo1["tt"]); ?>][]" class="mass" value="<?php echo ($vo1["mass"]); ?>" data-fufei='<?php if(($vo1["type"]) == "2"): ?>0<?php endif; if(($vo1["type"]) == "1"): ?>1<?php endif; if(($vo1["type"]) == "3"): ?>0<?php endif; ?>'>
                                <input type="hidden" name="price[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["tprice"]); ?>">
                                <input type="hidden" name="id[<?php echo ($vo1["tt"]); ?>][]" value="<?php echo ($vo1["id"]); ?>">
                            </strong>
                            <h2 class="red_col">￥<font><?php echo ($vo1["tprice"]); ?></font></h2>
                            <div class="wine_check">
                                <input type="checkbox" id="bzhxz<?php echo ($key); ?>" class="bzhxz" data-key="<?php echo ($key); ?>" onclick="showBox(this)" />
                                <label for="bzhxz<?php echo ($key); ?>" class="showbzhq">
                                    <span>选择红酒包装</span><u id="wine_pic<?php echo ($key); ?>" data-key="<?php echo ($key); ?>">
                                    <small></small></u>
                                </label>
                            </div>
                        </span>
                        <strong class="delect" onclick="delItem(this)"><i>×</i></strong>
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
        <div class="clear"></div>
        <label id="express_price" style="display:none;">20</label>
        <label id="express_overweight" style="display:none;">2</label>
        <label id="express_kg" style="display:none;"><?php echo ($kg); ?></label>

        <!-- 用户信息 -->
        <div class="user_info">
            <!-- 购买人 -->
            <div class="sl_user">
                <h3>购买人信息</h3>
                <input type="text" name="suser" id="suser" placeholder="姓名" />
                <input type="tel" name="sphone" id="sphone" placeholder="联系电话" onblur="validatePhone(this)" />
            </div>
            <!-- 收货人 -->
            <div class="sl_user">
                <h3>收货人信息</h3>
                <input type="text" name="huser" id="huser" placeholder="姓名" />
                <input type="tel" name="hphone" id="hphone" placeholder="联系电话" onblur="validatePhone(this)" />
                <style type="text/css">
                    .area_ctrl{height: 240px;}
                </style>
                <input type="text" name="city" id="demo1" readonly="true" placeholder="选择省市" value="江苏省-苏州市-姑苏区" />
                <input id="value1" type="hidden" />
                <textarea placeholder="街道信息" id="streen" name="street"/></textarea>
            </div>
        </div>
        <div class="kd_info">
            <em>顺丰快递/<font class="red_col" id="shunfeng"><?php echo ($mass_totals); ?></font>元</em>
            <input type="checkbox" class="shunfeng_ems" id="sfkd" style="display:none;" onclick="plushEMS(this)" value="1" name="shunfeng_ems"/>
            <label for="sfkd">到付</label>
        </div>
        <div class="prompt">
            <h3>支付成功后，您将收到订单编号，可随时登录官方查看物流信息</h3>
            <i>如未收到短信息请联系客服</i>
        </div>
    </form>
</div>
<div class="footer"></div>
<!-- 底部导航栏 -->
<div class="mytools">
    <span>共<font id="pro_sum"><?php echo ($nums); ?></font>件，需支付￥<i id="totals_price"><?php echo ($totals); ?></i>
     <input type="hidden" name="totals_price" value="<?php echo ($totals); ?>" id="totals_price1"></span>
    <a href="javascript:void(0);" id="online_pay" class="my_float_r addcart orange_bg">在线支付</a>
</div>
<script src="/Public/Wap/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Public/Wap/js/layer/layer.js" type="text/javascript"></script>
</body>
<script type="text/javascript">
    var phoneReg = /^1[3|4|5|7|8]\d{9}$/;
    $(function(){

        $('.wine_box_num').change(function () {
            get_boxes_price($(this));
            get_all_price();
        }); 
        $('.thbzh').click(function () {
            get_boxes_price_by_images($(this));
            get_all_price();
        });

        // 去除input样式
        $('.user_info input,.user_info textarea').focus(function() {
            $(this).removeClass('enter_error');
        });

        // 初次输入，收货人信息 == 购买人信息
        $('#suser').keyup(function(){
            $('#huser').val($(this).val());
        });
        $('#sphone').keyup(function(){
            $('#hphone').val($(this).val());
        });

        // 支付
        $('#online_pay').click(function(){
            if($('#suser').val() == ''){
                $('#suser').addClass('enter_error');
                return false;
            }
            if($('#sphone').val() == ''){
                $('#sphone').addClass('enter_error');
                return false;
            }
            if(!phoneReg.test($('#sphone').val())){
                $('#sphone').addClass('enter_error');
                return false;
            }
            if($('#huser').val() == ''){
                $('#huser').addClass('enter_error');
                return false;
            }
            if($('#hphone').val() == ''){
                $('#hphone').addClass('enter_error');
                return false;
            }
            if(!phoneReg.test($('#hphone').val())){
                $('#hphone').addClass('enter_error');
                return false;
            }
            if($('#demo1').val() == ''){
                $('#demo1').addClass('enter_error');
                return false;
            }
            if($('#streen').val() == ''){
                $('#streen').addClass('enter_error');
                return false;
            }

            $form = $('form');
            // layer.load(2, {
            //     shade: [0.3,'#000'] //0.1透明度的白色背景
            // });
            $.post($form.attr('action'),$form.serialize(),function (data) {
                if (data.status == 1) {
                    layer.closeAll('loading');
                    clearCookie();
                    //询问框
                    layer.confirm(data.msg, {
                        btn: ['想好了现在支付', '不买了没想好'] //按钮
                    }, function () {
                        layer.closeAll();
                        layer.open({
                            type: 2,
                            area: ['1024px', '850px'],
                            fix: false, //不固定
                            maxmin: true,
                            content: data.redirect
                        });
                    }, function () {
                        $.post('<?php echo U("oder/cancel");?>', {id: data.order_id}, function (data) {
                            if (data.status == 1) {
                                window.location.href = data.redirect;
                            } else {
                                layer.alert(data.msg, {icon: 2});
                            }
                        });
                    });
                }
            });
        });

        $('.wine_box_num').change(function(){
            if($(this).val() < 1){
                $(this).val(1) ;
            }
        });
    });

    // 购物车商品选中状态
    function inpCheck(obj){
        $obj =$(obj);
        if($obj.children('input').is(':checked')){
            $obj.parent().addClass('cart_check');
        }else{
            $obj.parent().removeClass('cart_check');
        }
        $('#totals_price').text(get_all_price());
    }

    // 选择城市
    var area1 = new LArea();
    area1.init({
        'trigger': '#demo1',
        'valueTo': '#value1',
        'keys' :{
            id:'value',
            name:'text'
        },
        'type': 2,
        'data': [provs_data, citys_data, dists_data]
    });

    // 手机验证
    function validatePhone(obj){
        var val = obj.value;
        if(val == ''){
            obj.className = 'enter_error';
            return false;
        }
        if(!phoneReg.test(val)){
            obj.className = 'enter_error';
            return false;
        }
    }

    // 增加减少
    $price = $('.red_col').text();
    function doPlus(obj,p){
        $obj = $(obj);
        var num = $obj.siblings('input[type="number"]').val();
        if(num == 0){
            $('.minus').on('click',function(){
                doMinus(this);
            });
        }
        ++num;
        if (num < 0)
            num = 1;
        $obj.prev().val(num);
        $tt = get_orther_price($obj,num);
        // $obj.siblings('input[type="number"]').val(num);
        $('#totals_price').text($tt);
    }
    function doMinus(obj,p){
        $obj = $(obj);
        var num = $obj.siblings('input[type="number"]').val();
        --num;
        if (num < 0) {
            $obj.removeAttr('onclick');
            num = 0;
        }
        $obj.siblings('input[type="number"]').val(num);
        $tt = get_orther_price($obj,num);
        $('#totals_price').text($tt);
        $('#totals_price1').val($tt);
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
                if($(this).children('label').children('input[type="checkbox"]').is(':checked')){
                    $price = $(this).children('span').children('h2').children('font').text();
                    $sum = $(this).children('span').children('strong').children('input[type="number"]').val();
                    $sf += parseInt($sum);
                    $prices += parseInt($price)*parseInt($sum);
                }
            }
        });
        $sm = get_ems_price();
        if($('#sfkd').is(':checked')){
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
            if($(this).children('label').children('input[type="checkbox"]').is(':checked')){
                $price = $(this).children('span').children('h2').children('font').text();
                $sum = $(this).children('span').children('strong').children('input[type="number"]').val();
                $ll =parseInt($price)*parseInt($sum);
                $prices +=$ll;
                $sf += parseInt($sum);
            }
        });
        $('#pro_sum').text($sf);

        //盒子价格
        $pp = get_boxes_totals();

        // 邮费价格
        $tt= get_ems_price();
        if($('#sfkd').is(':checked')){
            $tt=0;
        }
        $pry = $prices + $tt + $pp;
      
        $('#totals_price1').val($pry);
        $('#totals_price').text($pry);
        return $pry;
    }

    function plushEMS(obj) {
        $('#totals_price').text(get_all_price());
    }

    // 快递钱
    // function get_ems_price() {
    //     $mass=0;
    //     $price = 0;
    //     $tal=0;
    //     $kg=0;
    //     $('.cart_product').each(function () {
    //         if($(this).children('label').children('input[type="checkbox"]').is(':checked')){
    //             $number = $(this).children('span').children('strong').children('input.number').val();
    //             $input = $(this).children('span').children('strong').children('input.mass');
    //             if($input.attr('data-fufei')==1){
    //                 if($input.val()!=''){
    //                     $mass = parseFloat($input.val());
    //                     $kg +=$mass*$number;
    //                 }
    //             }
    //         }
    //     });
    //     $price = $('#express_price').text();
    //     alert($price);
    //     $overweight = $('#express_overweight').text();
    //     $tal = overweight(parseFloat($price),parseFloat($overweight),parseFloat($kg));

    //     if($('#sfkd').is(':checked')){
    //         $tal = 0;
    //     }
    //     $('#shunfeng').text($tal);
    //     return parseFloat($tal);
    // }

    function get_ems_price() {
        $mass=0;
        $tal=0;
        $kg = 0;
        $('.cart_product').each(function () {
            if($(this).children('label').children('input[type="checkbox"]').is(':checked')){
                $number = $(this).children('span').children('strong').children('input.number').val();
                $input = $(this).children('span').children('strong').children('input.mass');
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
            $tal = overweight(parseFloat($price),parseFloat($overweight),parseFloat($kg));

        }
        if($tal!=NaN){
            $('#shunfeng').text("￥"+$tal);
            return parseFloat($tal);
        }else {
            return 0;
        }
    }



    /**
     *计算价格
     * @param p
     * @param p1
     * @param h
     * @returns {*}
     */
    function overweight(p,p1,h) {
        if(h<=1){
            return p;
        }else{
            return p+(h-1)*p1;
        }
    }
    /**
     * 修改数字
     * @param obj
     * @param p
     */
    function change_sum(obj,p) {
        $obj = $(obj);
        $sum = $obj.val();
        if($sum==''){
            $obj.focus();
            return '';
        }
        $tt= get_all_price($obj);
        $('#totals_price').text($tt);
        //$('#pro_sum').text($sum);
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
            $.post('/Wap/Product/delItem',{i:$obj.attr('data-index')},function (data) {
               if(data.status=1){
                   layer.closeAll();
                   $obj.remove();
                    $('#totals_price').text(get_all_price());
                    window.location.reload();
                }
            });
        });
    }
    /**
     * 清除购物车
     */
    function clearItem() {
        layer.confirm('您确定要清空购物车吗？清空后后您将不能找回商品', {
            btn: ['确定','取消'] //按钮
        }, function(){
            clearCookie();
            $.get('/Wap/Product/delItems',function (data) {
                if(data.status==1){
                    layer.closeAll();
                    $('.cart_pro_list').empty();
                    $('#totals_price').text(get_all_price());
                    window.location.reload();
                }
            });
        });
    }
    function clearCookie(){
        var keys=document.cookie.match(/[^ =;]+(?=\=)/g);
        if (keys) {
            for (var i = keys.length; i--;){
               if(keys[i]!='PHPSESSID'){
                   $.cookie(keys[i], '', { expires: -1,path:'/'}); // 删除 cookie
               }
            }
        }
    }


    // 显示红酒包装盒
    function showBox(obj){
        $obj = $(obj);
        var key = $obj.attr('data-key');
        if($obj.is(':checked')){
            if($('.thbzh'+key).is(':checked')){
                $obj.next('label').children('u').children('small').show();
            }
            $obj.parent('div.wine_check').parent('span').siblings('div.wine_box').show();
        }else{
            $obj.next().children('u').children('small').hide();
            $obj.parent('div.wine_check').parent('span').siblings('div.wine_box').hide();
        }

        get_all_price();
    }

    // 显示红酒包装盒价格
    function showBoxPic(obj) {
        $obj = $(obj);
        var sPosition = $obj.parent('li').parent('ul').parent('div.wine_box').siblings('span').children('label').children('u').children('small');
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
            // $ckeckbox1 = $(this).parent('strong').siblings('input[type="checkbox"]');
            $ckeckbox1 = $(this).parent('span').siblings('label').children('input[type="checkbox"]');
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
                //  pric = pric.match(reg);
                //  $boxes_totals1 += parseFloat(pric);
                // }        
            }
        });
        
        // $tp = <?php echo ($totals); ?>;     
        
        // if($boxes_totals!=0){
        //  $tp = parseFloat($tp)+$boxes_totals;
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
                    if($(this).find('input[type="checkbox"]').is(':checked')){  //选中盒子
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
                    if($(this).find('input[type="checkbox"]').is(':checked')){  //选中盒子
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
            $('#wine_pic'+$key).find('small').text('￥'+$boxes_price+"元").show();
        }else {
            $('#wine_pic'+$key).find('small').empty().hide();
        }
        return $boxes_price;
    }
</script>
</html>