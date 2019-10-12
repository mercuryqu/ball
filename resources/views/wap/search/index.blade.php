@extends('layouts.wap.app')

@section('title', '搜索')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/css/dropload.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/dropload.min.js') }}"></script>
    <script src="{{ asset('statics/wap/js/search.js') }}"></script>
@endsection

@section('content')
    <div style="padding: 0 0.3rem;position:fixed;top: 0rem;width: 100%;box-sizing:border-box;z-index: 100;background: #fff;">
        <div style="padding: 0;text-align: left;height: 0.88rem;line-height: 0.88rem;border-bottom: none;font-size: 0.55rem;color: #333333;margin-top: 0.58rem;">搜索</div>
        <div class="s_iptlop">
            <span class="s_iptlop_span"></span>
            <form action="javascript:search('input');" class="input-kw-form">
                <input class="s_ipt" id="keyword" type="search" value="" placeholder="搜索你想要的小程序">
            </form>
        </div>
    </div>
    <div class="conten" style=" margin-top: 3rem;">

        @if($keywords->count() > 0)
            <div class="hotgrabble">
                <h3 class="hot-search-name">热门搜索</h3>
                @foreach($keywords as $keyword)
                    <div class="hotgrabblea">
                        <p onclick="search(this)">{{ $keyword->name or '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <p class="show"></p>
    </div>
    @include('layouts.wap._menu')

    <!-- 弹出层start -->
    <div class="fext">
        <span class=" conten_con_sp">搜索</span>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var page = 1;
        function ajax_execute(ajax_url) {
            $('show').dropload({
                scrollArea: window,
                domUp: {
                    domClass: 'dropload-up',
                    domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
                    domUpdate: '<div class="dropload-update">↑释放加载</div>',
                    domLoad: '<div class="dropload-load"><span class="loading"></span>数据加载中...</div>'
                },
                domDown: {
                    domClass: 'dropload-down',
                    domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
                    domLoad: '<div class="dropload-load"><span class="loading"></span>数据加载中...</div>',
                    domNoData: '<div class="dropload-noData">没有更多啦！</div>'
                },

                loadUpFn: function (me) {
                    ajax_search(ajax_url, me);
                },

                loadDownFn: function (me) {
                    ajax_search(ajax_url, me);
                },
                threshold: 50,
                distance: 50
            });
        }

        function ajax_search(ajax_url, me) {
            $.ajax({
                type: 'GET',
                url: ajax_url,
                data: {'page': page},
                dataType: 'text',
                success: function (data) {
                    page++;
                    if (data == '') {
                        page = 1;
                        me.lock();
                        $('.dropload-down').remove();
                        me.noData();
                        return false;
                    }
                    $('.show').append(data);
                    me.resetload();
                },
                error: function (xhr, type) {
                    layer.msg('数据错误!');
                    me.resetload();
                }
            });
        }

        function search(obj) {
            var keyword;
            $('.hotgrabble').hide();
            if (obj == 'input') {
                keyword = $.trim($('#keyword').val());
            } else if (obj != undefined || obj != '') {
                keyword = $.trim($(obj).html());
                $('#keyword').val(keyword);
            }

            if (keyword !== undefined && keyword.length > 0) {
                // ajax url
                ajax_url = '{{ route('wap.search.data') }}?keyword=' + keyword;

                $('.show').html('');
                ajax_execute(ajax_url);
            } else {
                layer.msg('请输入有效关键词！');
                return false;
            }
        }

        $(function () {
            var wechat_share_config = {
                appId: '{{ $sign_package["app_id"] }}',
                timestamp: '{{ $sign_package["timestamp"] }}',
                nonceStr: '{{ $sign_package["nonce_str"] }}',
                signature: '{{ $sign_package["signature"] }}'
            };

            var wechat_share_obj = {
                title: '搜索', // 分享标题
                desc: '快来找找你所需的小程序吧。',
                imgUrl: '/statics/wap/favicon.ico' // 分享图标
            };

            wechat_share(wechat_share_config, wechat_share_obj);
        });
    </script>
@endsection