jQuery(function ($) {

    let str = '';
    let count = '';

    $('#cashVoucher').on('change', () => {
        let amountOfMoney = $('#cashVoucher option:checked').text();
        let amountOfMoneyLength = amountOfMoney.length;
        str = amountOfMoney.substr(0, amountOfMoneyLength-1);
        CalculationMoney(str, count);
        let val = $('#cashVoucher option:checked').val();
        if (val == '') {
            $('#allMoney').text(`¥ 0.00 元`);
        }
    });

    $('#count').on('keyup', function () {
        count = this.value;
        if ($('#cashVoucher option:checked').val() == '') {
            return false;
        }
        CalculationMoney(str, count);

    })
    let CalculationMoney = (str, count) => {
        let moneyCount = str * count ;
        $('#allMoney').text(`¥ ${moneyCount} 元`);
    }


    $.validator.addMethod("productCount", function (value, element) {
        let reg = /^[1-5]?$/
        if (reg.exec(value)) {
            return true;
        } else {
            return false;
        }
    });

    $('#validation-form').validate({

        errorElement: 'div',

        errorClass: 'help-block',

        focusInvalid: false,

        rules: {

            cashVoucher: {required: true},
            count: {required: true, productCount: true},
            userName: {required: true, chinese: true},
            telephone: {required: true, mobile: true}

        },

        messages: {

            cashVoucher: {required: '请选择现金券面值.'},
            count: {required: '请输入数量.', productCount: '数量最少为1，最多为5.'},
            userName: {required: '请输入姓名.', chinese: '请输入正确格式的姓名.'},
            telephone: {required: '请输入手机号码.', mobile: '请输入正确格式的手机号码.'},

            subscription: "Please choose at least one option",

            gender: "Please choose gender",

            agree: "Please accept our policy"

        },

        invalidHandler: function (event, validator) {

            $('.alert-danger', $('.login-form')).show();

        },

        highlight: function (e) {

            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');

        },

        success: function (e) {

            $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
            $(e).remove();

        },

        errorPlacement: function (error, element) {

            if (element.is(':checkbox') || element.is(':radio')) {

                var controls = element.closest('div[class*="col-"]');

                if (controls.find(':checkbox,:radio').length > 1) controls.append(error); else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));

            } else if (element.is('.select2')) {

                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));

            } else if (element.is('.chosen-select')) {

                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));

            } else error.insertAfter(element.parent());

        },

        submitHandler: function (form) {

            $.ajax({

                type: "POST",

                url: "/git/web/index.php/Intels/EFuliPay",

                data: {
                    cashVoucher: $('#cashVoucher').val(),
                    count: $('#count').val(),
                    userName: $('#userName').val(),
                    cashVoucher: $('#cashVoucher').val(),
                    telephone: $('#telephone').val(),
                    PayType: $('#PayType').val(),
                    userid: $('#userid').val(),
                    systemUserSysNo: $('#systemUserSysNo').val()
                },

                async: false,

                success: function (response) {
				if(response.Code==0){
                    var payInfo = response['PayInfo'];
					<php>if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ){</php>
                    WeixinJSBridge.invoke('getBrandWCPayRequest',{
                        "appId": payInfo.appId, //公众号名称，由商户传入
                        "timeStamp": payInfo.timeStamp, //时间戳，自1970 年以来的秒数
                        "nonceStr": payInfo.nonceStr, //随机串
                        "package": payInfo.package,
                        "signType": payInfo.signType, //微信签名方式:
                        "paySign": payInfo.paySign//微信签名,
                    },function(res){
                        if (res.err_msg == "get_brand_wcpay_request:ok") {
                            // 此处可以使用此方式判断前端返回,微信团队郑重提示：res.err_msg 将在用户支付成功后返回ok，但并不保证它绝对可靠。
							if(response['Ad_Info']['Switch']==0){
								location.href ="<php>echo C('AD_HOST');</php>";

							}else{
								 WeixinJSBridge.call( 'closeWindow' );
							}
                        }else{
							WeixinJSBridge.call( 'closeWindow' );
						}
                    });
					<php>}</php>
					<php>if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ){</php>
						var trade_no = response['PayInfo'];
						AlipayJSBridge.call("tradePay", {
							tradeNO: trade_no
						}, function (result) {
							if ( result.resultCode=="9000") {
								if(response['Ad_Info']['Switch']==0){
									location.href ="<php>echo C('AD_HOST');</php>";
//								location.href ="<php>echo C('AD_HOST');</php>"+'?amount='+response['Ad_Info']['Fee']+'&product='+response['Ad_Info']['CustomerName'];

								}else{
									 AlipayJSBridge.call('closeWebview');
								}
							}else{
								AlipayJSBridge.call('closeWebview');
							}
						});
					<php>}</php>
                }else{
					alert('支付失败！');
				}

                }

            });

        },

        invalidHandler: function (form) {

            console.log("ajax失败！");

        }

    });

});