@extends('layouts.wap.app')

@section('title', '小程序分类')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/categories-index.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/swiper.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/categories-index.js') }}"></script>
@endsection

@section('content')
    <!-- title -->
    <div class="Recommend">
        <div class="swiper-container banner">
            <div class="swiper-wrapper">
                @foreach($carousels as $carousel)
                    <div class="swiper-slide blue-slide slides">
                        @if($carousel->image_url)
                            @if($carousel->jump_type == 0)
                                <a href="{{ route('wap.apps.show', $carousel->app_id) }}">
                                    <img src="{{ $carousel->image_url or '' }}" />
                                </a>
                            @elseif($carousel->jump_type ==1)
                                <a href="{{ $carousel->jump_url }}">
                                    <img src="{{ $carousel->image_url or '' }}"/>
                                </a>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination my-pagination-clickable"></div>
        </div>
    </div>


    <!-- 二级菜单start -->
    <div class="Recommend_er">

        <div class="Recommend_er_list">

            <div class="" style="box-sizing: border-box;    padding-bottom: 0.3rem;">
                @forelse($first_level_categories as $category)
                    <span class="lists" data-ng-app="{{ $loop->index+1 }}" onclick="show_category_apps('{{ route('wap.categories.apps', $category->id) }}', '{{ $category->id }}')">
                        <img src="{{ $category->icon or '/statics/wap/images/category_default_ico.png' }}" alt="{{ $category->name or '' }}">
                        <p>{{ $category->name }}</p>
                    </span>
                @endforeach
            </div>
        </div>
        <div class="Recommend_er_dwon">
            <img src="{{ asset('statics/wap/images/down-arrow.png') }}">
        </div>
        <div class="lccm">
            <div class="iccmcont">
                @forelse($first_level_categories as $category)
                    <span class="list @if($loop->index == 0) lopk @endif" data-ng-bind="{{ $loop->index+1 }}"
                          onclick="show_category_apps('{{ route('wap.categories.apps', $category->id) }}', '{{ $category->id }}')">
                        <img src="{{ $category->icon or '/statics/wap/images/category_default_ico.png' }}" alt="{{ $category->name or '' }}">
                        <p>{{ $category->name }}</p>
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- apps list -->
    <div class="conten">
        <div class="napes_s">
            @foreach($first_category_apps as $first_category_app)
                @include('layouts.wap.common.list', ['item' => $first_category_app])
            @endforeach
        </div>
        <a class="category-more" href="{{ route('wap.categories.show', 1) }}" style="display: @if($first_category_app_count > 10) block @else none @endif; color: black;">查看更多</a>
    </div>
    <!-- content end -->
    @include('layouts.wap._menu')

    <!-- 弹出层start -->
    <div class="fext">
        <span class="conten_con_sp">分类</span>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        // get category apps
        function show_category_apps(ajax_url, category_id)
        {
            $.get(ajax_url + '?per_page=10&type=index', function (result) {
                var html = '';
                $.each(result.data, function (index, value) {
                    var id = value.id ? value.id : 0;
                    var logo = value.logo ? value.logo : '{{ asset('statics/wap/images/logo_default.png') }}';
                    var name = value.name ? value.name : '';
                    var slogan = value.slogan ? value.slogan : '';
                    var code = value.code ? value.code : '{{ asset('statics/wap/images/code_default.png') }}';
                    html += app_list(id, logo, name, slogan, code);
                });
                $('.napes_s').html(html);
                var total = result.total;
                // category show url
                var header = window.location.protocol;
                var category_show_url = header + '//' + window.location.host + '/categories/' + category_id;
                $('.category-more').css('display', 'none');
                if (total > 10) {
                    $('.category-more').attr('href', category_show_url);
                    $('.category-more').css('display', 'block');
                }
            });
        }

        $(function () {
            var mySwiper = new Swiper('.banner.swiper-container',{
                autoplay: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    clickableClass : 'my-pagination-clickable'
                }
            });
        });

        var wechat_share_config = {
            appId: '{{ $sign_package["app_id"] }}',
            timestamp: '{{ $sign_package["timestamp"] }}',
            nonceStr: '{{ $sign_package["nonce_str"] }}',
            signature: '{{ $sign_package["signature"] }}'
        };

        var wechat_share_obj = {
            title: '分类', // 分享标题
            desc: '你想要找的小程序，这里都有。',
            imgUrl: '/statics/wap/favicon.ico' // 分享图标
        };

        wechat_share(wechat_share_config, wechat_share_obj);
    </script>
@endsection