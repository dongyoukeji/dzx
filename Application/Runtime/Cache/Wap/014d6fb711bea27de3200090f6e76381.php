<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('oder/get_goods');?>" method="post" id="form">
    <!-- 商品列表 -->
    <div class="cart_pro_list">
        <!-- 商品 -->
        <div class="cart_product">
            <label>
                <b><img src="<?php echo ($vo["image"]); ?>"></b>
            </label>
            <span>
                <h3><?php echo ($vo["title"]); ?></h3>
                <p class="gray_col2"><?php echo (get_pro_left($vo["description"])); ?></p>
                <p class="gray_col2"><?php echo (get_pro_right($vo["description"])); ?></p>
                <strong style="display:none;">
                    <input type="hidden" name="mass" value="<?php echo ($vo["mass"]); ?>" id="mass" class="mass" data-fufei='1'>
                    <input type="hidden" name="huan" value="1" id="huan" class="number">
                    <input type="hidden" name="coupon_cid" value="<?php echo ($vo["coupon_cid"]); ?>">
                </strong>
                <h2 class="red_col">￥<font><?php echo ($vo["tprice"]); ?></font></h2>
                 <input type="hidden" name="id" value="<?php echo ($vo["coupons_id"]); ?>" id="id">
                 <input type="hidden" name="tprice" value="<?php echo ($vo["tprice"]); ?>" id="tprice">
                 <input type="hidden" name="coupon_cid" value="<?php echo ($vo["coupon_cid"]); ?>" id="coupon_cid">
                 <input type="hidden" name="shunfeng_price" value="0" id="shunfeng_price">
            </span>
        </div>
    </div>
    <div class="clear"></div>
    <!-- 用户信息 -->
    <div class="user_info">
        <!-- 收货人 -->
        <div class="sl_user">
            <h3>收货人信息</h3>
            <input type="text" name="suser" id="suser" placeholder="姓名">
            <input type="tel" name="sphone" id="sphone" placeholder="联系电话">
            <style type="text/css">
                ._citys{width: 97%;}
            </style>
            <input type="text" name="city" readonly="true" id="city" placeholder="选择省市" value="江苏省-苏州市-姑苏区">
            <textarea placeholder="街道信息" name="street" id="street"></textarea>
        </div>
    </div>
    <div class="kd_info">
        <em>顺丰快递/<font class="red_col" id="shunfeng"><?php echo ($mass_totals); ?></font>元</em>
        <input type="checkbox" class="shunfeng_ems" id="sfkd" style="display:none;" onclick="plushEMS(this)" value="1" name="shunfeng_ems"/>
        <label for="sfkd">到付</label>
    </div>
    <input type="button" value="确认兑换" id="online_pay" class="submit" style="margin-top:10px;"/>

    <label id="express_price" style="display:none;">12</label>
    <label id="express_overweight" style="display:none;">2</label>
    <label id="express_kg" style="display:none;"><?php echo ($kg); ?></label>
</form>
<script>
    $(function(){
        var phoneReg = /^1[3|4|5|7|8]\d{9}$/;
        // 选择城市
        var area1 = new LArea();
        area1.init({
            'trigger': '#city',
            'valueTo': '#value1',
            'keys' :{
                id:'value',
                name:'text'
            },
            'type': 2,
            'data': [provs_data, citys_data, dists_data]
        });
        // 去除input样式
        $('.user_info input,.user_info textarea').focus(function() {
            $(this).removeClass('enter_error');
        });
        // 支付
        $('#online_pay').click(function() {
            if ($('#suser').val() == '') {
                $('#suser').addClass('enter_error');
                return false;
            }
            if ($('#sphone').val() == '') {
                $('#sphone').addClass('enter_error');
                return false;
            }
            if (!phoneReg.test($('#sphone').val())) {
                $('#sphone').addClass('enter_error');
                return false;
            }
            if ($('#city').val() == '') {
                $('#city').addClass('enter_error');
                return false;
            }
            if ($('#street').val() == '') {
                $('#street').addClass('enter_error');
                return false;
            }
            $form = $('#form');

            layer.load(2, {
                shade: [0.3,'#000'] //0.1透明度的白色背景
            });
            $.post($form.attr('action'),$form.serialize(),function (data) {
                if(data.status==1){
                    layer.alert(data.msg,{icon:1,end:function () {
                        window.location.href='<?php echo U("index/index");?>';
                    }});
                }else{
                    layer.alert(data.msg,{icon:2});
                }
            });
        });
    });
    function plushEMS(obj) {
        $('#totals_price').text(get_all_price());
    }
    /**
     * 获取所有的价格
     * @returns {number}
     */
    function get_all_price() {
        $prices =0;
        $sf=0;
//        $('.cart_product').each(function () {
//            if($(this).children('label').children('input[type="checkbox"]').is(':checked')){
//                $price = $(this).children('span').children('h2').children('font').text();
//                $sum = $(this).children('span').children('strong').children('input[type="number"]').val();
//                $ll =parseInt($price)*parseInt($sum);
//                $prices +=$ll;
//                $sf += parseInt($sum);
//            }
//        });
        $('#pro_sum').text($sf);

        // 邮费价格
        $tt= get_ems_price();
        if($('#sfkd').is(':checked')){
            $tt=0;
        }
        $pry = $tt;
        $('#shunfeng').text("￥"+$pry);
        $('#shunfeng_price').val($pry);
        return $pry;
    }

    function get_ems_price() {
        $mass=0;
        $tal=0;
        $kg = 0;
        $('.cart_product').each(function () {

            $number = $(this).children('span').children('strong').children('input.number').val();
            $input = $(this).children('span').children('strong').children('input.mass');
            if($input.attr('data-fufei')==1){
                if($input.val()!=''){
                    $mass = parseFloat($input.val());
                    $kg +=$mass*$number;
                }
            }

        });

        if($kg>0){
            $price = $('#express_price').text();
            $overweight = $('#express_overweight').text();
            $tal = overweight(parseFloat($price),parseFloat($overweight),parseFloat($kg));

        }
        if($tal!=NaN){
            //$('#shunfeng').text("￥"+$tal);
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

</script>