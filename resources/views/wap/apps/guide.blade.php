@extends('layouts.wap.v2.app')

@section('title', '提交小程序须知')

@section('content')
<!-- 内容部分 -->
<div class="upload">
    <div class="list clearfix">
        <div class="left fl">
            <img src="{{ asset('statics/wap/v2/image/upload1.png') }}" alt="">
            <p>示例图</p>
        </div>
        <div class="right fl">
            <p class="title">小程序LOGO</p>
            <p>建议尺寸：100×100（像素）</p>
            <p>建议形状：正方形</p>
            <p>格式支持：JPG／JPEG／PNG</p>
        </div>
    </div>
    <div class="list clearfix">
        <div class="left fl">
            <img src="{{ asset('statics/wap/v2/image/upload3.png') }}" alt="">
            <p>示例图</p>
        </div>
        <div class="right fl">
            <p class="title">小程序二维码</p>
            <p>建议尺寸：200×200（像素）</p>
            <p>建议形状：正方形</p>
            <p>格式支持：JPG／JPEG／PNG</p>
        </div>
    </div>
    <div class="list clearfix">
        <div class="left fl">
            <img src="{{ asset('statics/wap/v2/image/picture.png') }}" alt="">
            <p>示例图</p>
        </div>
        <div class="right fl">
            <p class="title">小程序截图</p>
            <p>建议尺寸：420×750（像素）</p>
            <p>建议形状：长方形</p>
            <p>格式支持：JPG／JPEG／PNG</p>
        </div>
    </div>
</div>

<a href="{{ route('wap.apps.create') }}"><button id="read" class="btn" style="margin: 5rem auto;">已阅读</button></a>

<div class="help">
    <span>遇到问题？您可以</span>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=3596440571&site=qq&menu=yes"> 联系客服</a>
</div>
@endsection