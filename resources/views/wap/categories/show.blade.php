@extends('layouts.wap.app')

@section('title', $category->name)

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/css/categories-show.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/css/dropload.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/js/dropload.min.js') }}"></script>
@endsection

@section('content')
    <!-- title -->
    <div class="headline-title">
        <span style="font-weight: 800">{{ $category->name or '' }}</span>
    </div>

    <div class="conten">
        <div id="list"></div>
        @include('layouts.wap.common._back')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var ajax_category_url = '{{ route('wap.categories.apps', $category) }}';
        $(function () {

            var wechat_share_config = {
                appId: '{{ $sign_package["app_id"] }}',
                timestamp: '{{ $sign_package["timestamp"] }}',
                nonceStr: '{{ $sign_package["nonce_str"] }}',
                signature: '{{ $sign_package["signature"] }}'
            };

            var wechat_share_obj = {
                title: '{{ $category->name }}', // 分享标题
                desc: '{{ get_setting_value_by_key('wap_app_slogan') }}',
                imgUrl: '/statics/wap/favicon.ico' // 分享图标
            };

            wechat_share(wechat_share_config, wechat_share_obj);

            var page = 1;
            $('.conten').dropload({
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

                loadDownFn: function (me) {
                    $.ajax({
                        type: 'GET',
                        url: ajax_category_url,
                        data: {'page': page},
                        dataType: 'text',
                        success: function (data) {
                            page++;
                            if (data == '') {
                                me.lock();
                                me.noData();
                            }
                            $('#list').append(data);
                            me.resetload();
                        },
                        error: function (xhr, type) {
                            layer.msg('数据错误!');
                            me.resetload();
                        }
                    });
                },
                loadUpFn: function (me) {
                    $.ajax({
                        type: 'GET',
                        url: home_ajax_url,
                        data: {'page': page},
                        dataType: 'text',
                        success: function (data) {
                            page++;
                            if (data == '') {
                                me.lock();
                                me.noData();
                            }
                            $('#list').append(data);
                            me.resetload();
                        },
                        error: function (xhr, type) {
                            layer.msg('数据错误');
                            me.resetload();
                        }
                    });
                },
                threshold: 50,
                distance: 50
            });
        });
    </script>
@endsection