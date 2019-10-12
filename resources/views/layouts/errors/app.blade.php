<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('statics/admin/css/error.css') }}"/>
    <!--[if IE 6]>
    <script src="{{ asset('statics/admin/css/error.js') }}"></script>
    <script>DD_belatedPNG.fix('*')</script>
    <![endif]-->
</head>
<body>
    <div id="wrap">
        @yield('content')
    </div>
    <div class="animate below"></div>
    <div class="animate above"></div>
</body>
</html>
