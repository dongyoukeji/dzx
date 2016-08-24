<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('oder/get_goods');?>" method="post" id="form">
    <!-- 商品列表 -->
    <div class="cart_pro_list">
        <!-- 商品 -->
        <div class="cart_product">
            <label>
                <b><img src="<?php echo ($vo["image"]); ?>"></b>
            </label>
        <span title="<?php echo ($vo["title"]); ?>">
            <h3><?php echo ($vo["title"]); ?></h3>
            <p class="gray_col2"> <?php echo (get_pro_details($vo["description"])); ?></p>
            <!--<p class="gray_col2">4只母蟹2.0-2.5两</p>-->
            <!--<strong>-->
                <!--<input type="button" name="minus" value="-" class="jiajian minus" disabled />-->
                <!--<input type="number" name="num" value="<?php echo ($nums); ?>" class="number" disabled>-->
                <!--<input type="button" name="plus" value="+" class="jiajian plus" disabled/>-->
            <!--</strong>-->
            <label>数量：<?php echo ($nums); ?>个</label>
            <h2 class="red_col">￥<?php echo ($totals); ?></h2>
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
            <input type="text" name="city" readonly="true" id="city" placeholder="选择省市">
            <textarea placeholder="街道信息" name="street" id="street"></textarea>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo ($vo["coupons_id"]); ?>" id="id">
    <input type="hidden" name="tprice" value="<?php echo ($vo["tprice"]); ?>" id="tprice">
    <input type="hidden" name="coupon_cid" value="<?php echo ($vo["coupon_cid"]); ?>" id="coupon_cid">
    <input type="hidden" name="mass" value="<?php echo ($vo["mass"]); ?>" id="mass">
    <input type="hidden" name="huan" value="1" id="huan">
    <input type="button" value="确认兑换" id="online_pay" class="submit" />
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
                        window.location.href='U("index/index")';
                    }});
                }else{
                    layer.alert(data.msg,{icon:2});
                }
            });
        });
    });
</script>