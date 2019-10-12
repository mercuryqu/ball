@extends('layouts.wap.app')

@section('title', $app->name)
@section('keyword', $app->keyword)
@section('description', $app->instruction)

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/apps-show.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/css/share.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/apps-show.js') }}"></script>
    <script src="{{ asset('statics/wap/js/swiper.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/social-share.min.js') }}"></script>
@endsection

@section('content')
    <!-- content -->
    <div class="conten">
        <!-- 内容start -->
        <div class="container">
            <div class="conten_con">
                <!-- 头部start -->
                <div class="clearfix">
                    <div class="conten_con_con">
                        @if($app->logo)
                            <img id="app-logo" class="logo-img" src="{{ $app->logo or '' }}"/>
                        @endif
                    </div>
                    <div class="conten_con_right ">
                        <h4 id="app-title">{{ $app->name or '' }}</h4>
                        <span class="category-style">
                        @foreach($app->categories()->limit(3)->get()->pluck('name', 'id') as $key=>$category)
                            <a href="{{ route('wap.categories.show', $key) }}">{{ $category }}</a>
                            @if($app->categories()->get()->count() > 1 && $loop->index != $app->categories()->get()->count()-1)
                                <span class="infloil">|</span>
                            @endif
                        @endforeach
                        @if($app->categories()->count() > 3) <a href="#category">·····</a> @endif
                        </span>
                    </div>
                </div>
                <!-- 二维码star -->
                <div class=" QR_code">
                    <img src="{{ $app->code or '' }}">

                    <p class="QR_code_p">长按识别小程序码</p>

                    <div class="QR_code_button">
                        <b style="display: block;opacity: 0;position: absolute;top: 19%;">{{ $app->name or '' }}</b>
                        <button class="btn QR_code_l" data-clipboard-action="copy" data-clipboard-target="b">复制名称</button>
                        <span class="QR_code_r" onclick="call()">分享</span>

                    </div>
                </div>
                <!-- 二维码end -->
                <!--头部end -->
            </div>
        </div>
        <!-- 轮播图start -->
        <div class="container">
            <h3 class="comment-title">预览</h3>
            <div class="particulars">
                <div class="swiper-container swiper-container-horizontal banner" id="swiper-container3">
                    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                        @foreach($app->images as $image)
                            <div class="swiper-slide swiper-slides red-slide swiper-slide-next" style="width:200px;">
                                <img class="swiper-img" src="{{ $image->url or '' }}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        <!--  轮播图end -->
        <!-- 简介start -->
            <div class="synopsis desc">
                <ul>
                    <li>
                        <div class="branddesc">{{ $app->instruction or '' }} </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 简介end -->

        <!-- 评论start -->
        <div class="container">
            <div class="synopsis">
                <div class="synopsis_pl_sp">
                    <h3>评论</h3>
                </div>

                <!-- 一条评论start -->
                <div class="swiper-container case">
                    <div class="swiper-wrapper">
                        <!-- 一页start -->
                        @forelse($comments as $comment)
                            <div class="swiper-slide swiper-slidee blue-slide slidesd">
                                <div class="synopsis_pol">

                                    <div class="synopsis_pol_lo">
                                        <div class="opsi clearfix">
                                            <span class="opsi_left">{{ $comment->member->name or ''}}</span>
                                            <span class="opsi_right">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <ul class="synopsis_pol_xx clearfix ">
                                            {!! make_star($comment->star) !!}
                                        </ul>
                                        <p>{{ $comment->body or '' }}</p>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p>暂无评论！</p>
                        @endforelse
                        <!-- 一页end -->
                    </div>
                </div>
                <div class="synopsis_pl_sps">
                    <a href="{{ route('wap.apps.comments.create', $app) }}"><h5><span class="synopsis_spans"></span>评论</h5></a>
                    @if($comment_count > 3)
                        <a href="{{ route('wap.apps.comments', $app) }}">
                            <span class="synopsis_pl_spls">
                                查看全部
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <!-- 评论end -->
        <!-- 开发者信息start -->
        <div class="container">
            <div class="information">
                <h3>小程序信息</h3>
                <span class="information_input_r"  >
                    <span class="category-label">类别</span>
                        <span class="information_input_r_span">
                            <a name="category"></a>
                            @foreach($app->categories()->get()->pluck('name', 'id') as $key=>$category)
                                <a href="{{ route('wap.categories.show', $key) }}">{{ $category }}</a>
                                @if($app->categories()->get()->count() > 1 && $loop->index != $app->categories()->get()->count()-1)
                                    <span class="infloil">|</span>
                                @endif
                            @endforeach
                        </span>
                </span>
            </div>
        </div>
        <!-- 开发者信息end -->

        <!-- 你可能还喜欢start -->
        <div class="container">
            <div class="synopsis">
                <div class="synopsis_pl_sp">
                    <h5 class="syukl">你可能还喜欢</h5>
                </div>
                <!-- 一条评论start -->

                <div class="swiper-container  cases">
                    <div class="swiper-wrapper">
                        <!-- 一页start -->
                        @foreach($recommend_apps as $recommend_app)
                            @if($recommend_app->isNotEmpty())
                                <div class="swiper-slide swiper-slidee blue-slide">
                                    @foreach($recommend_app as $item)
                                        @include('layouts.wap.common.list', ['item' => $item])
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- 内容start -->

        <!-- share div start -->
        <div data-component="SimpleModal" class="share-modal" style="position: fixed; left: 0; top: 0; width: 100vw;">
            <div class="stop-propagation">
                <div data-component="MiniappWechatShareHelpModal">
                    <div class="content-wrapper">
                        <div class="share-menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- share div end -->

        <!-- share div start -->
        <div data-component="SimpleModal-qxz" class="share-modal-top" style="position: fixed; left: 0; top: 0; width: 100vw;">
            <div class="stop-propagation">
                <div data-component="MiniappWechatShareHelpModal-qxz">
                    <div class="content-wrapper">
                        <div class="share-tips">
                            <img class="icon-image" src="" alt="图标">
                            <p class="text">这个小程序不错，推荐给朋友试试！</p>
                        </div>
                        <div class="header">
                            <span class="app-name limit-name">小程序</span>
                            <p class="title">球小站—国内领先的小程序应用平台</p>
                        </div>
                        <div class="icon-triangle"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- share div end -->

        @include('layouts.wap.common._back')
    </div>

    <div class="fext">
       
        <span class="fext_pol">
            @if($app->logo)
                <img class="logo-img" src="{{ $app->logo or '' }}"/>
            @endif
        </span>
        <span class="conten_con_sp macks"
              onclick="show_code('{{ $app->name or '' }}', '{{ $app->code or '' }}')">体验</span>
    </div>
    <!-- content end -->
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            // share config
            var $config = {
                source              : window.location.href,
                title               : "{{ $app->name }}",
                description         : '{{ $app->instruction }}',
                image               : "{{ $app->logo }}",
                sites               : ['qzone', 'qq', 'weibo','wechat'],
                wechatQrcodeTitle   : "微信扫一扫：分享",
                wechatQrcodeHelper  : '<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈。</p>'
            };

            {{--// share init--}}
            socialShare('.share-menu', $config);

            // wechat share
            var wechat_share_config = {
                appId: '{{ $sign_package["app_id"] }}',
                timestamp: '{{ $sign_package["timestamp"] }}',
                nonceStr: '{{ $sign_package["nonce_str"] }}',
                signature: '{{ $sign_package["signature"] }}'
            };

            var wechat_share_obj = {
                title: '{{ $app->name }}', // 分享标题
                desc: '我在球小栈找到了一个小程序，你也赶紧来试试~',
                imgUrl: '{{ $app->logo }}' // 分享图标
            };

            wechat_share(wechat_share_config, wechat_share_obj);


            $('.share-modal-top').on("click",function(){
                $("body").css("overflow","auto");
                $('.share-modal-top').fadeOut()
            });
            $(".icon-wechat").on("click",function(){
                return false;
            });
            $(".share-modal").on("click",function(){
                $("body").css("overflow","auto");
                $('.share-modal').fadeOut()
            });

            var clipboard = new ClipboardJS('.btn');

            clipboard.on('success', function (e) {
                layer.msg('复制成功！');
            });

            clipboard.on('error', function (e) {
                layer.msg('复制成功！');
            });
            var mySwiper = new Swiper('.banner', {
                pagination: '.banner .swiper-pagination',
                slidesPerView: 'auto', //'auto'
                zoom: true,
                onTransitionEnd: function (swiper) {
                    if (swiper.progress == 1) {
                        swiper.activeIndex = swiper.slides.length - 1
                    }
                }
            });
            var mySwipers = new Swiper('.case', {
                pagination: '.case .swiper-pagination',
                slidesPerView: 'auto', //'auto'
                onTransitionEnd: function (swiper) {
                    if (swiper.progress == 1) {
                        swiper.activeIndex = swiper.slides.length - 1
                    }
                }
            });

            var mySwipersy = new Swiper('.cases', {
                pagination: '.cases .swiper-pagination',
                slidesPerView: 'auto', //'auto'
                onTransitionEnd: function (swiper) {
                    if (swiper.progress == 1) {
                        swiper.activeIndex = swiper.slides.length - 1
                    }
                }
            });
        });

        function call() {
            if (! is_weixin()) {
                $('.share-modal').fadeIn();
            } else {
                var is_wechat_env = window.__wxjs_environment === 'miniprogram';
                if (is_wechat_env) {
                    $('.icon-triangle').css('margin-right', '0.8rem');
                }
                var title = $('#app-title').text();
                var logo = $('#app-logo').attr('src');
                $('.app-name').text(title);
                $('.icon-image').attr('src', logo);
                $('.share-modal-top').fadeIn();
            }
        }

        function is_weixin(){
            var ua = navigator.userAgent.toLowerCase();
            if(ua.match(/MicroMessenger/i)=="micromessenger") {
                return true;
            } else {
                return false;
            }
        }

        $(function () {
            var wjx_none = '☆',
                    wjx_sel = '★';
            $(".comment").on("mouseenter", "li", function () {
                // 鼠标移入：让当前的元素和它前面的所有兄弟变为实心
                // end方法：结束当前链最近的一次过滤操作，并且返回匹配元素之前的状态
                $(this).text(wjx_sel).prevAll().text(wjx_sel).end().nextAll().text(wjx_none);
            }).on("mouseleave", function () {
                // 先让所有的五角星变为空心
                $(".comment").children().text(wjx_none);
                // 让具有clicked类的元素变为实心，并且它前面的所有元素也变为实心
                $(".clicked").text(wjx_sel).prevAll().text(wjx_sel);
            }).on("click", "li", function () {
                // 给当前元素添加类，给它所有的兄弟元素移除类
                // 此处clicked类，只做标识用
                $(this).addClass("clicked").siblings().removeClass("clicked");
            });
        });

        (function ($) {
            $.fn.moreText = function (options) {
                var defaults = {
                    maxLength: 50,
                    mainCell: ".branddesc",
                    openBtn: '查看更多',
                    closeBtn: '收起'
                };
                return this.each(function () {
                    var _this = $(this);

                    var opts = $.extend({}, defaults, options);
                    var maxLength = opts.maxLength;
                    var TextBox = $(opts.mainCell, _this);
                    var openBtn = opts.openBtn;
                    var closeBtn = opts.closeBtn;

                    var countText = TextBox.html();
                    var newHtml = '';
                    if (countText.length > maxLength) {
                        newHtml = countText.substring(0, maxLength) + '...<span class="more">' + openBtn + '</span>';
                    } else {
                        newHtml = countText;
                    }
                    TextBox.html(newHtml);
                    TextBox.on("click", ".more", function () {
                        if ($(this).text() == openBtn) {
                            TextBox.html(countText + ' <span class="more">' + closeBtn + '</span>');
                        } else {
                            TextBox.html(newHtml);
                        }
                    })
                })
            };

            $(".desc ul li").moreText({
                maxLength: 60,
                mainCell: '.branddesc'
            });
        })(jQuery);
//        $(function () {
//            $(".desc ul li").moreText({
//                maxLength: 60,
//                mainCell: '.branddesc'
//            });
//        })
    </script>


@endsection