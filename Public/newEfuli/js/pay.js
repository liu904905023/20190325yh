jQuery(function ($) {

    let count = '';
    let moneyValue = ''
    let reg = /^\d+\.\d+$/

    function accMul(arg1, arg2) {
        // m 位数 s1,s2 转为字符串
        var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

        try {
            // 获取 s1 s2 小数点后位数
            m = s1.split(".")[1].length
            m = s2.split(".")[1].length

        } catch (e) {
        }
        // 小数点替换为空字符串，再转为 Number 类型，相乘后，除以 10 的 m 次幂
        return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
    }

    Number.prototype.mul = function (arg) {
        return accMul(arg, this);
    }

    $('#cashVoucher').on('change', () => {
        let amountOfMoney = $('#cashVoucher option:checked').text();
        let end = amountOfMoney.lastIndexOf('元');
        moneyValue = Number(amountOfMoney.substr(0, end));

        CalculationMoney(moneyValue, count);

    });

    $('#count').on('keyup', function () {
        count = this.value = this.value.substr(0, 1);
        console.log(count);
        CalculationMoney(moneyValue, count);
    })
    let CalculationMoney = (str, count) => {
        let moneyCount = accMul(str, count);
        if (reg.exec(moneyValue) && $('#count').val() != '') {
            $('#allMoney').text(`¥ ${moneyCount} 元`);
        } else {
            moneyCount = moneyCount + '.00';
            $('#allMoney').text(`¥ ${moneyCount} 元`);
        }

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
            count: {required: true, productCount: true, maxLength: 1},
            userName: {required: true, chinese: true},
            telephone: {required: true, mobile: true},
            checkTelephone: {required: true, mobile: true, equalTo: '#telephone'}
        },

        messages: {

            cashVoucher: {required: '请选择现金券面值.'},
            count: {required: '请输入数量.', productCount: '请输入数字1-5.'},
            userName: {required: '请输入姓名.', chinese: '请输入正确格式的姓名.'},
            telephone: {required: '请输入电话号码.', mobile: '请输入正确格式的电话号码.'},
            checkTelephone: {required: '请再次填写电话号码.', mobile: '请输入正确格式的电话号码', equalTo: '两次输入的电话号码不一致.'},

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
            $('#tipModal').modal('show');
            $.ajax({

                type: "POST",

                url: "__SELF__",

                data: {},

                async: false,

                success: function (data) {


                }

            })

        },

        invalidHandler: function (form) {
            console.log("ajax失败！");
        }
    });
    // 验证所有项
    // function abc(obj) {
    //
    //     obj.on('blur', function () {
    //         let a = $("#validation-form").valid();
    //         console.log(a)
    //         if (a) {
    //             console.log('全部通过');
    //         } else {
    //             console.log('尚未通过');
    //         }
    //     })
    // }
    //
    // abc($('input'));
})