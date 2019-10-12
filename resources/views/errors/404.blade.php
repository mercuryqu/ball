@extends('layouts.errors.app')

@section('title', '404 Page Not Found')

@section('content')
    <div>
        <img src="{{ asset('statics/admin/img/error/404.png') }}" alt="404" />
    </div>
    <div id="text">
        <strong>
            <span></span>
            <a href="{{ strpos(request()->url(), '/admin/') ? route('admin.home') : route('wap.home') }}">返回首页</a>
            <a href="javascript:history.back()">返回上一页</a>
        </strong>
    </div>
@endsection