@extends('layouts.wap.v2.app')

@section('title', '登录')

@section('content')
    <div class="msg">
        <p>输入你的手机号</p>
        <p>以登录或创建新的账号</p>
    </div>

    <label for="telephone"></label>
    <input type="tel" id="tel" placeholder="请正确输入11位手机号码" value="{{ old('telephone') }}" name="telephone" maxlength="11" {{--class="err"--}}/>

    <button id="next" class="btn">下一步</button>

    <!-- <div class="fast">
        <p>快捷登录</p>
        <i class="iconfont icon-weixin"></i>
    </div> -->
@endsection

@section('script')
    <script>
        $(function () {
            // 在input输入框中判断当输入框中的字不为空时，就让button的透明度增加
            $("#tel").keyup(function (event) {
                var event = event || window.event;
                var tel = $("#tel").val();
                // 获取输入框中的内容
                if (tel.length < 11 && event.keyCode == 8) {
                    $("#next").css({ "opacity": 0.3 });
                }

                if (tel.length === 11) {
                    if ((/^1[3|4|5|8][0-9]\d{8}$/.test(tel))) {
                        // 改变button的透明度
                        $("#next").css({ "font-size": "22/15rem", "opacity": 0.8, "color": "#000" });
                    }
                }
                else {
                    // 如果不是11位就让透明度变成0.3
                    $("#tel").css({ "font-size": "16/15rem", "opacity": 0.3 });
                }
            })


            // Send sms code to telephone
            $("#next").click(function () {
                // 获取输入的手机号
                var tel = $("#tel").val();
                if (tel.length === 11 && (/^1[3|4|5|6|7|8|9][0-9]\d{8}$/.test(tel))) {
                    $.post('{{ route('helper.sms.store') }}', {'telephone': tel}, function (result) {
                        var code = result.code;
                        var message = result.message;
                        if (code === 60000) {
                            // 成功接发送数据后，跳转到验证码
                            layer.msg(message);
                            window.location.href = "{{ route('wap.auth.verification') }}?telephone=" + tel;
                            return false;
                        } else if (code === 60001) {
                            layer.msg(message);
                            return false;
                        }
                    });
                } else {
                    $("#phone_msg").html("请输入正确的手机号格式");
                    return false;
                }
            });
        })
    </script>
@endsection