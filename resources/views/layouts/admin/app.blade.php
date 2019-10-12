<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{ $menus[request()->route()->action['as']] or '默认标题' }} - 后台管理
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Vendor Css -->
    <link rel="stylesheet" href="{{ asset('statics/admin/css/vendor.css') }}">
    <!-- App Css -->
    <link rel="stylesheet" href="{{ asset('statics/admin/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <!-- Main Header -->
    @include('layouts.admin._header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.admin._sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content-header')

        <!-- Main content -->
        <section class="content">
            <!-- Include message div -->
            @include('layouts.admin._message')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- Main Footer -->
    @include('layouts.admin._footer')
    <!-- Control Sidebar -->
    @include('layouts.admin._control')

</div>
<!-- ./wrapper -->

<!-- Modals -->
@yield('modals')

<!-- AdminLTE SCRIPTS -->
@include('layouts.admin._js')
@yield('js')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>