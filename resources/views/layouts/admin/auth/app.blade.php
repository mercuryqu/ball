<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登录 - {{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Vendor Css -->
  <link rel="stylesheet" href="{{ asset('statics/admin/css/vendor.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('admin.home') }}"><b>{{ config('app.name') }}</b>{{ config('app.alias') }}</a>
  </div>

  <!-- /auth-errors -->
  @include('layouts.admin.auth.common.errors')
  <!-- /global message -->
  @include('layouts.admin.auth._message')

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">后台登录</p>
    @yield('content')
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- AdminLTE SCRIPTS -->
<script src="{{ asset('statics/admin/js/vendor.js') }}"></script>
@yield('js')

</body>
</html>
