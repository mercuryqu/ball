<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="ball" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no" />
    <title>@yield('title') - 小程序 - {{ get_setting_value_by_key('global_app_name') }}{{ request()->routeIs('wap.home') ? ' - ' . get_setting_value_by_key('wap_app_slogan') : '' }}</title>
    <link rel="apple-touch-icon" sizes="64x64" href="{{ asset('statics/wap/favicon.ico') }}" />
    <link href="{{ asset('statics/wap/favicon.ico') }}" rel="shortcut icon" />
    <meta name="keywords" content="@yield('keyword', get_setting_value_by_key('wap_app_keyword'))"/>
    <meta name="description" content="@yield('description', get_setting_value_by_key('wap_app_description'))"/>
    <link rel="stylesheet" href="{{ asset('statics/wap/v2/css/index.css') }}" />
    @yield('css')
    <script type="text/javascript"> var wap_base_url = '{{ route('wap.home') }}' </script>
</head>
<body>
    @yield('content')
</body>
<script src="{{ asset('statics/wap/v2/js/lib/jquery-1.11.1.js') }}"></script>
<script src="{{ asset('statics/wap/layer/layer.js') }}"></script>
@yield('js')
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
