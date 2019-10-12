@extends('layouts.wap.v2.app')

@section('title', '小程序预览')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/v2/css/lib/swiper.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/v2/js/lib/swiper.min.js') }}"></script>
@endsection

@section('content')
<!-- 内容部分 -->
    <div class="scan">
        <div class="preview_info">
            <div class="info clearfix">
                <div class="left fl">
                    <img src="{{ asset('statics/wap/v2/image/upload3.png') }}" alt="" id="Plogo">
                </div>
                <div class="right">
                    <div class="name" class="fr" id="Pname">支付宝让生活更加简单</div>
                    <ul class="clearfix" id="Plist">
                        <li>生活</li>
                        <li>社交</li>
                        <li>旅游</li>
                        <li>...</li>
                    </ul>
                </div>
            </div>
            <div class="pic_code">
                <img src="{{ asset('statics/wap/v2/image/upload2.jpg') }}" alt="" id="Pcode">
                <p>长按识别二维码</p>
            </div>
            <div class="btn_box clearfix">
                <button class="fl">复制名称</button>
                <button class="fr">撰写评价</button>
            </div>
        </div>
        <div class="preview">
            <h4>预览</h4>
            <!-- 轮播图 -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('statics/wap/v2/image/picture.png') }}" class="Pscreen" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('statics/wap/v2/image/screen1.png') }}" class="Pscreen" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('statics/wap/v2/image/picture.png') }}" class="Pscreen" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('statics/wap/v2/image/screen1.png') }}" class="Pscreen" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('statics/wap/v2/image/picture.png') }}" class="Pscreen" alt="">
                    </div>
                </div>
            </div>
            <!-- 描述 -->
            <div class="preview_describe">
                支付宝（中国）网络技术有限公司是国内的第三方支付平台，致力于提供“简单、安全、快速”的支付解决方案。支付宝公司从2004年建立开始，始终以“信任”作为产品和服务的核心。旗下有“支付宝”与“支付宝钱包”两个独立品牌。
            </div>
            <!-- 简介 -->
            <div class="preview_abstract">
                蚂蚁金服对外发布2015年支付宝年账单。账单显示，2015年互联网经济继续保持高速增长。按省级行政区划分来看，上海人均支付金额排名全国首位，达到104155元，这标志着网上人均支付开始迈入“10万时代”。从移动支付笔数占比来看，排前五位的地区分别是西藏、贵州、甘肃、陕西和青海，其移动支付占比高达83.3%、79.7%、79.4%、78.8%和78.7%。统计还显示，2015年移动支付笔数占整体比例高达65%，而2014年这个数字是49.3%。
            </div>
        </div>
        <input type="button" class="btn" value="确认提交审核" / >
    </div>
@endsection

@section('script')
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // 获取传过来的formData对象
        var jsonData = JSON.parse(window.name);
        //   获取每个value值，填充在页面相应的位置
        var name = jsonData.name;
        var abstract = jsonData.abstract;
        var describe = jsonData.describe;
        var classifyArray = jsonData.classifyArray;
        var classifyArrId = jsonData.classifyArrId;
        var screenshotArr = jsonData.screenshotArr;
        var code = jsonData.code;
        var logo = jsonData.logo;
        // 填充名称
        $("#Pname").text(name);

        // 填充分类
        var Plist = document.getElementById("Plist");
        var classifyLiArr = Plist.getElementsByTagName("li");
        for (var i = 0; i < classifyArray.length; i++) {
            $(classifyLiArr[i]).text(classifyArray[i]);
        }
        // 填充logo
        $("#Plogo").attr("src", logo);

        // 填充小程序码
        $("#Pcode").attr("src", code);

        // 填充描述
        $(".preview_describe").text(describe);

        // 填充简介
        $(".preview_abstract").text(abstract);

        // 填充截图
        var PscreenArray = document.getElementsByClassName("Pscreen");
        for (var i = 0; i < screenshotArr.length; i++) {
            $(PscreenArray[i]).attr("src", screenshotArr[i]);
        }

        // 把数据放进formData中,提交数据
        var formData = new FormData();
        // 上传表单数据
        var logo_file = dataURLtoFile(logo, 'logo_file');
        var code_file = dataURLtoFile(code, 'code_file');
        // 小程序名称
        formData.append("name", name);
        // 小程序描述
        formData.append("slogan", describe);
        // 小程序简介
        formData.append("instruction", abstract);
        // 小程序logo
        formData.append("logo_file", logo_file);
        // 小程序码
        formData.append("code_file", code_file);
        // 小程序分类
        formData.append("categories", classifyArrId.join(','));

        // 小程序截图

        for (var i = 0; i < screenshotArr.length; i++) {
            formData.append('image_files[]', dataURLtoFile(screenshotArr[i], 'image_file' + i));
        }

        // 发送ajax
        // 点击提交审核按钮，发送ajax请求
        $(".btn").click(function () {
            $('.btn').attr('disabled', true);
            $.ajax({
                url: "{{ route('wap.apps.store') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    var code = data.code;
                    var message = data.message;
                    if (code == 80000) {
                        layer.msg(message);
                        window.location.href = '{{ route('wap.members.show') }}';
                        return false;
                    } else {
                        layer.msg(message);
                        $('.btn').attr('disabled', false);
                        return false;
                    }
                },
                error: function (err) {
                }
            })
        })

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            pagination: {
                clickable: false
            },
        });
    })

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {type:mime});
    }

</script>
@endsection