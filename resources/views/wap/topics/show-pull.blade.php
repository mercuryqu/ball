@extends('layouts.wap.app')

@section('title', $topic->title)

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/topic-show-pull.css') }}">
@endsection

@section('content')
    <div>
        <div class="conten_con_topimgs" style="background: url('{{ $topic->banner or '' }}') no-repeat;background-size: 100%;"></div>
        <div class="radius-header"></div>
        <div class="app-list-container">
            @foreach($apps as $app)
                @include('layouts.wap.common.list', ['item' => $app])
            @endforeach
            <p class="no-more">没有更多啦！</p>
        </div>
        @include('layouts.wap.common._back')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            var wechat_share_config = {
                appId: '{{ $sign_package["app_id"] }}',
                timestamp: '{{ $sign_package["timestamp"] }}',
                nonceStr: '{{ $sign_package["nonce_str"] }}',
                signature: '{{ $sign_package["signature"] }}'
            };

            var wechat_share_obj = {
                title: '{{ $topic->title }}', // 分享标题
                desc: '{{ $topic->title }}',
                imgUrl: '{{ $topic->banner }}' // 分享图标
            };

            wechat_share(wechat_share_config, wechat_share_obj);
        });
    </script>
@endsection
