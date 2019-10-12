<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="email=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <meta name="author" content="ball" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="full-screen" content="yes">--}}
    {{--<meta name="x5-fullscreen" content="true">--}}
    <title>@yield('title') - 小程序 - {{ get_setting_value_by_key('global_app_name') }}{{ request()->routeIs('wap.home') ? ' - ' . get_setting_value_by_key('wap_app_slogan') : '' }}</title>
    <link rel="apple-touch-icon" sizes="64x64" href="{{ asset('statics/wap/favicon.ico') }}" />
    <link href="{{ asset('statics/wap/favicon.ico') }}" rel="shortcut icon" />
    <meta name="keywords" content="@yield('keyword', get_setting_value_by_key('wap_app_keyword'))"/>
    <meta name="description" content="@yield('description', get_setting_value_by_key('wap_app_description'))"/>
    <link rel="stylesheet" href="{{ asset('statics/wap/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/css/base.css') }}">
    @yield('css')
    <script type="text/javascript"> var wap_base_url = '{{ route('wap.home') }}' </script>
    <script src="{{ asset('statics/wap/js/jquery-1.10.1.min.js') }}"></script>
    <script src="{{ asset('statics/wap/layer/layer.js') }}"></script>
    <script src="{{ asset('statics/wap/js/rem.js') }}"></script>
    <script src="{{ asset('statics/wap/js/config.js') }}"></script>
    <script src="{{ asset('statics/wap/js/base.js') }}"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
    @yield('js')
</head>

<body onload="setTimeout(function(){window.scrollTo(0,1)},100);">
@yield('content')

@include('layouts.wap._code')
</body>
@yield('script')
    <!-- <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?2204ff94b07c58ea125deb31e9aa5d9a";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script> -->
</html>