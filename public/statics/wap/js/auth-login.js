// 验证手机号码格式
function checkPhone() {
    var telephone = $("#telephone").val();
    var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;

    if (!myreg.test(telephone)) {
        $("#phone_msg").html("请输入正确的手机号格式");
        return false;
    } else {
        $("#phone_msg").html("");
        return true;
    }
}

// 验证验证码格式
function checkCode() {
    var code = $("#code").val();
    var code_regex = /^\d{6}$/;
    if (! code_regex.test(code)) {
        $("#code_msg").html("请输入正确的验证码格式");
        return false;
    } else {
        $("#code_msg").html("");
        return true;
    }
}

var countdown = 60;
function setTime(obj) {
    if (countdown == 0) {
        obj.removeAttribute("disabled");
        obj.value = "免费获取验证码";
        countdown = 60;
        return;
    } else {
        obj.setAttribute("disabled", true);
        obj.value = "重新发送(" + countdown + ")";
        countdown--;
    }
    setTimeout(function () {
        setTime(obj)
    }, 1000)
}