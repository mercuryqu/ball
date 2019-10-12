@extends('layouts.wap.app')

@section('title', '精选')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/css/dropload.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/swiper.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/dropload.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/home.js') }}"></script>
 
@endsection

@section('content')
    <div class="conten">
        <!-- title -->
        <div class="headline">精选
            <a href="{{ route('wap.auth.login') }}">
                <img src=" @if(session()->get('member')) {{ session()->get('member')->avatar }} @else /statics/wap/images/account-light.png @endif">
            </a>
        </div>

        <!-- content -->
        <div class="conten_con"></div>

        <!-- Menus -->
        @include('layouts.wap._menu')

        <!-- header title -->
        <div class="fext" style="display: block;">
            <span class="headline_span"></span>
            <span class="fext_pol"></span>
            <span class=" conten_con_sp macks">精选</span>
        </div>
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
                title: '首页', // 分享标题
                desc: '{{ get_setting_value_by_key('wap_app_slogan') }}',
                imgUrl: '/statics/wap/favicon.ico' // 分享图标
            };

            wechat_share(wechat_share_config, wechat_share_obj);
        });
    </script>
@endsection
