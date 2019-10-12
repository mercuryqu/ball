@extends('layouts.wap.v2.app')

@section('title', '输入验证码')

@section('content')
    <div class="msg">
        <p>验证码已发送到手机</p>
        <p class="tel_send">{{ $telephone }}</p>
    </div>

    <!-- 输入验证码 -->
    <div class="identifying clearfix">
        <input type="number" maxlength="6" id="identifying-input" oninput="if(value.length>1)value=value.slice(0,6)">
        <div class="fake-box">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
            <input type="number" maxlength="1" oninput="if(value.length>1)value=value.slice(0,1)">
        </div>
        <a href=""></a>
    </div>
    <p class="time">00 : <span class="Countdown">60</span>秒后 重新发送验证码</p>
    <button id="login" class="btn">登录</button>
    <span id="box"></span>
@endsection

@section('script')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var code = '';
            countDown();

            function countDown()
            {
                //   页面加载进来就执行定时器
                var time = 10000;
                var second = time / 1000;
                $(".Countdown").text(second);
                var IntervalName = setInterval(function () {
                    // 把总时间转换成分秒的形式
                    second--;
                    if (second >= 0 && second < 10) {
                        $(".Countdown").text("0" + second);
                    }
                    else if (second <= 0) {
                        // 清除定时器，并修改.time的样式
                        clearInterval(IntervalName);
                        $(".time").html('<a href="#" id="re-verify-code">重发验证码</a>');
                        $(".time a").css({ "color": "rgba(69,230,123,1)", "font-weight": 700, "font-size": "13/15rem" })

                        setTimeout(function(){
                             // 重新发送验证码
                            $('#re-verify-code').on('click', function () {
                                var telephone = '{{ $telephone }}';

                                $.post('{{ route('helper.sms.store') }}', {'telephone': telephone}, function (result) {
                                    layer.msg(result.message);
                                    return false;
                                });
                                    
                                $(".time").html('<p class="time" style="margin-left:0">00'+':<span class="Countdown">10</span>'+'秒后 重新发送验证码</p>');
                                countDown();
                            });
                        },50)
                       
                    }
                    else {
                        $(".Countdown").text(second);
                    }
                }, 1000);
            };

            var $input = $(".fake-box input");
            $("#identifying-input").on("input", function (event) {
                var event = event || window.event;
                var result = $(this).val().trim();
                for (var i = 0, len = result.length; i < len; i++) {
                    $input.eq("" + i + "").val(result[i]);
                }
                $input.each(function () {
                    var index = $(this).index();
                    if (index >= len) {
                        $(this).val("");
                    }
                });
                if (len == 6) {
                    code = result;
                    $("#login").css("opacity", 0.8);
                }
                if (result.length < 6) {
                    $("#login").css("opacity", 0.4);
                }
            });

            $("#login").click(function () {
                console.log(code);
                var telephone = '{{ $telephone }}';

                $.post('{{ route('wap.auth.login') }}', {'telephone': telephone, 'code': code}, function (result) {
                    var code = result.code;
                    var message = result.message;
                    if (code === 60007) {
                        layer.msg(message);
                        window.location.href = result.data.redirect_url;
                        return false;
                    } else {
                        layer.msg(message);
                        return false;
                    }
                });
            })
        })
    </script>
@endsection