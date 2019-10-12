@extends('layouts.wap.app')

@section('title', '撰写评论')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/comments-create.css') }}">
@endsection

@section('content')
    <div class="page-title">
        <span class="headline_spanl" onclick="javascript:history.go(-1)">取消</span>
        撰写评论
        <span class="headline_spanr" id="send">发送</span>
    </div>
    <div class="copr">
        <ul class="synopsis_pol_xx clearfix comment">
            <li>☆</li>
            <li>☆</li>
            <li>☆</li>
            <li>☆</li>
            <li>☆</li>
        </ul>
        <p>轻点星型来评分</p>
    </div>

    <div class="s_iptlop">
        {!! Form::textarea('body', old('body'), ['class' => 's_iptl', 'id' => 'body', 'placeholder' => '评论内容']) !!}
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            var wjx_none = '☆',
                wjx_sel = '★';
            var star = 0;

            $(".comment").on("mouseenter", "li", function () {
                // 鼠标移入：让当前的元素和它前面的所有兄弟变为实心
                // end方法：结束当前链最近的一次过滤操作，并且返回匹配元素之前的状态
                $(this).text(wjx_sel).prevAll().text(wjx_sel).end().nextAll().text(wjx_none);
            }).on("mouseleave", function () {
                // 先让所有的五角星变为空心
                $(".comment").children().text(wjx_none);
                // 让具有clicked类的元素变为实心，并且它前面的所有元素也变为实心
                $(".clicked").text(wjx_sel).prevAll().text(wjx_sel);
            }).on("click", "li", function (e) {
                // 给当前元素添加类，给它所有的兄弟元素移除类
                // 此处clicked类，只做标识用
                $(this).addClass("clicked").siblings().removeClass("clicked");
                star = $(this).prevAll().length + 1;
            });

            // send comment
            $('#send').click(function () {
                var body = $('#body').val();

                if (star === 0) {
                    layer.msg('请给小程序评分！');
                    return false;
                }

                if (body.length < 10) {
                    layer.msg('请输入最少10个字符评论内容！');
                    return false;
                }

                $.post('{{ route('wap.apps.comments.store', $app) }}', {'star': star, 'body': body}, function (result) {
                    var code = result.code;
                    var message = result.message;
                    if (code === 50000) {
                        layer.msg(message);
                        history.back(-1);
                        return false;
                    } else if (code === 50001) {
                        layer.msg(message);
                    }
                });
            });
        });
    </script>
@endsection