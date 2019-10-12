@extends('layouts.wap.v2.app')

@section('title', $member->name . '的账户')

@section('content')
    <!-- 内容部分 -->
    <div class="person">
        <div class="info">
            <img src="{{ $member->avatar or '/statics/wap/images/account-light.png' }}" alt="{{ $member->name }}">
            <p class="nickname">{{ $member->name }}</p>
            <p class="tel">{{ $member->telephone }}</p>
            <p class="submit_icon">
                <i class="iconfont icon-xiaochengxu"></i>
                &nbsp;<a style="color: white;" href="{{ route('wap.apps.guide') }}">提交小程序</a></p>
        </div>
        <!-- tab栏切换 -->
        <div class="tab">

            <ul id="status" class="clearfix">
                <li class="current">
                    <p class="number">{{ $passed_apps->total() }}</p>
                    <p>已发布</p>
                    <i></i>
                </li>
                <li>
                    <p class="number">{{ $pending_apps->total() }}</p>
                    <p>待审核</p>
                    <i></i>
                </li>
                <li>
                    <p class="number">{{ $un_passed_apps->total() }}</p>
                    <p>审核未通过</p>
                    <i></i>
                </li>
            </ul>
            <div class="list release choice">
                <ul>
                    @foreach($passed_apps as $app)
                    <li>
                        <div class="logo">
                            <img class="img-radius" src="{{ $app->logo }}" alt="{{ $app->name }}">
                        </div>
                        <div class="right clearfix">
                            <div class="name">{{ $app->name }}</div>
                            <!-- <div class="edit">编辑</div> -->
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="list audit">
                <ul>
                    @foreach($pending_apps as $app)
                    <li>
                        <div class="logo">
                            <img class="img-radius" src="{{ $app->logo }}" alt="{{ $app->name }}">
                        </div>
                        <div class="right clearfix">
                            <div class="name">{{ $app->name }}</div>
                            <div class="edit">不可编辑</div>
                        </div>
                    </li>
                    @endforeach
                </ul>


            </div>
            <div class="list fail">
                <ul class="onPass">
                    @foreach($un_passed_apps as $app)
                    <li>
                        <div class="top clearfix">
                            <div class="logo">
                                <img class="img-radius" src="{{ $app->logo }}" alt="{{ $app->name }}">
                            </div>
                            <div class="right clearfix">
                                <div class="name">
                                    <p>{{ $app->name }}</p>
                                    <p class="inform">
                                        <span class="iconfont icon-info"></span> 您的小程序未通过审核，请查看原因。
                                    </p>
                                </div>
                                <i class="iconfont icon-jiantouxia drop"></i>
                            </div>
                        </div>

                        <div class="flod">
                            <ol>
                                @if($app->reasons)
                                    @foreach($app->reasons as $reason)
                                        <li>{{ $reason or '' }}</li>
                                    @endforeach
                                @endif
                            </ol>
                        </div>
                    </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(function () {
        // tab栏切换
        $("#status li").click(function () {
            // 排他思想把当前点击的li的子元素i添加select
            $(this).addClass("current").siblings("li").removeClass("current");
            // 获取点击的li的索引
            var index = $(this).index();
            // 让index对应的list显示
            $(".list").eq(index).addClass("choice").siblings(".list").removeClass("choice");
        })

        // 点击下拉按钮展示隐藏部分

        var ul = document.getElementsByClassName("onPass")[0];
        var ulliArr = $(ul).children("li");
        var dropArr = document.getElementsByClassName("drop");
        console.log(ulliArr.length);
        for (var i = 0; i < ulliArr.length; i++) {

            $(dropArr[i]).click(function () {
                // 判断ol是否有show类名
                $(this).parent().parent().siblings(".flod").toggleClass("show");
                if ($(this).parent().parent().siblings(".flod").hasClass("show")) {
                    // 如果在显示，就把字体图标转换成向下的箭头
                    $(this).removeClass("icon-jiantouxia").addClass("icon-jiantoushang");
                }
                else {
                    $(this).removeClass("icon-jiantoushang").addClass("icon-jiantouxia");

                }
            })

        }

    })
</script>
@endsection