@extends('layouts.wap.app')

@section('title', $topic->title)

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/topics-show.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/NativeShare.js') }}"></script>
    <script src="{{ asset('statics/wap/js/topics-show.js') }}"></script>
@endsection

@section('content')
    <!-- title -->
    <div class="conten">
        <div class="topic-title" style="width: 100%;background: url('{{ $topic->banner or '' }}') no-repeat center;background-size: 100% 100%;">
        </div>
        <div class="conten_con">
            <div>
                {!! $topic->body !!}
            </div>

            <div class="napes_s">
                @foreach($apps as $app)
                    @include('layouts.wap.common.list', ['item' => $app])
                @endforeach
            </div>

            <div class="Native" onclick="call()">
                <img src="{{ asset('statics/wap/images/share.png') }}">
            </div>
        </div>

    </div>

    <div class="fext">
        <span class="conten_con_sp">{{ $topic->title or '' }}</span>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var nativeShare = new NativeShare();
        var shareData = {
            title: 'NativeShare',

            desc: 'NativeShare',
            // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
            link: 'https://github.com/fa-ge/NativeShare',
            icon: 'https://pic3.zhimg.com/v2-080267af84aa0e97c66d5f12e311c3d6_xl.jpg',

            success: function () {
                layer.msg('success')
            },
            fail: function () {
                layer.msg('fail')
            }
        }
        nativeShare.setShareData(shareData);

        function call(command) {
            try {
                nativeShare.call(command)
            } catch (err) {
                // 如果不支持，你可以在这里做降级处理
                layer.msg(err.message)
            }
        }

        function setTitle(title) {
            nativeShare.setShareData({
                title: title,
            })
        }
    </script>
@endsection