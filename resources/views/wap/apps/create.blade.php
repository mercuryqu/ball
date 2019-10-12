@extends('layouts.wap.v2.app')

@section('title', '提交小程序须知')

@section('css')
    <link rel="stylesheet" href="{{ asset('statics/wap/v2/css/imgUpload.css') }}">
    <link rel="stylesheet" href="{{ asset('statics/wap/v2/css/global-min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('statics/wap/v2/js/lib/jquery-1.11.1.js') }}"></script>
    <script src="{{ asset('statics/wap/v2/js/imgUpload.js') }}"></script>
    <script src="{{ asset('statics/wap/v2/js/seed-min.js') }}"></script>
@endsection

@section('content')
<!-- 内容部分 -->
    <div class="commit1">
        <form action="" id="info" onsubmit="return CheckForm()">

            <!-- 小程序名称 -->
            <div class="name list">
                <input type="text" name="name" placeholder="请输入小程序名称" maxlength="10" id="name">
                <div class="number">
                    <span id="name_enter">0</span>
                    <span id="name_total">/10</span>
                </div>
            </div>
            <!-- 小程序描述 -->
            <div class="describe list">
                <textarea name="describe" placeholder="请用一句话描述它" maxlength="30" id="describe"></textarea>
                <div class="number">
                    <span id="describe_enter">0</span>
                    <span id="describe_total">/30</span>
                </div>
            </div>
            <!-- 小程序所属分类 -->
            <div class="classify list">
                <div class="choice">
                    <div class="classify_info">请选择小程序分类</div>
                    <div class="select clearfix" id="inp_box">
                    </div>
                    <div class="number">
                        <span id="classify_enter">0</span>
                        <span id="classify_total">/3</span>
                    </div>
                    <i class="iconfont icon-jiantouxia drop"></i>
                </div>
                <ul class="clearfix switch">
                    @foreach($first_level_categories as $category)
                    <li data-category_id="{{ $category->id }}">
                        <img src="{{ asset('statics/wap/v2/image/close.png') }}" alt="">
                        <span>{{ $category->name or '' }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- 小程序简介 -->
            <div class="abstract list">
                <textarea name="abstract" placeholder="请输入小程序的简介" maxlength="200" id="abstract"></textarea>
                <div class="number">
                    <span id="abstract_enter">0</span>
                    <span id="abstract_total">/200</span>
                </div>
            </div>
            <!-- 上传小程序logo -->
            <div class="logo list">
                <div class="upload">请上传您的小程序logo</div>
                <!-- <form id="form_face_logo" enctype="multipart/form-data" > -->
                <input type="file" name="fileToUpload_logo" id="fileToUpload_logo">
                <!-- </form> -->
                <img id="pic_logo" class="normalFace" src="{{ asset('statics/wap/v2/image/add.png') }}" onclick="fileSelectLogo()">
                <div class="close">
                    <img class="switch" src="{{ asset('statics/wap/v2/image/close.png') }}" alt="">
                </div>
            </div>
            <!-- 上传小程序码 -->
            <div class="code list">
                <div class="upload">请上传您的小程序码</div>
                <input type="file" name="fileToUpload_code" id="fileToUpload_code">
                <!-- </form> -->
                <img id="pic_code" class="normalFace" src="{{ asset('statics/wap/v2/image/add.png') }}" onclick="fileSelectCode()">
                <div class="close">
                    <img class="switch" src="{{ asset('statics/wap/v2/image/close.png') }}" alt="">
                </div>
            </div>
            <!-- 上传小程序截图 -->
            <div class="screenshot list">
                <div class="upload">请上传您的小程序截图</div>
                <div class="number">
                    <span id="screenshot_enter">0</span>
                    <span id="screenshot_total">/5</span>
                </div>
                <div id="upload"></div>
            </div>
            <div class="preview">
                <input type="submit" id="submit" class="btn" value="预览一下" style="opacity:0.8">
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // 上传小程序logo
        var logoFile;
        // 传入的小程序和二维码尺寸限制
        var maxWidth = 1200;
        var maxHeight = 1200;
        //  点击小程序logo添加图标触发input点击事件
        function fileSelectLogo() {
            document.getElementById("fileToUpload_logo").click();
        }

        // 选择logo文件后执行的函数
        $("#fileToUpload_logo").on("change", function () {
            var file = this.files[0];
            if (window.FileReader) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                //监听文件读取结束后事件    
                reader.onloadend = function (e) {
                    var e = e || window.e;
                    // console.log("================"+e.target.result);
                    // 把加号按钮图片转换成上传的图片
                    // 创建img标签(用于看是否传入的图片过大或过小)
                    var img = $("<img id='img' src=" + e.target.result + ">");

                    setTimeout(function () {
                        var size = $('#fileToUpload_logo').get(0).files[0].size;
                        var width = img[0].width;
                        var height = img[0].height;
                        if (width !== 100 && height !== 100) {
                            layer.msg("上传的图片尺寸不等于100px");
                            return;
                        }
                        if (size > 20480) {
                            layer.msg("上传的图片大小不大于20kb");
                            return;
                        }
                        else {
                            $("#pic_logo").attr("src", e.target.result); //e.target.result就是最后的路径地址
                            // 让关闭按钮显示
                            $(".logo .close").css("display", "block");
                            logoFile = e.target.result;
                        }
                    }, 200);
                };
            }
        })

        // 点击关闭按钮，关闭选中的logo图片
        $(".logo .close").click(function () {
            $("#fileToUpload_logo").val('');
            $(".logo .close").css("display", "none");
            $(".logo>img").attr("src", "{{ asset('statics/wap/v2/image/add.png') }}");
        })

        // 上传小程序码
        var codeFile;
        //  点击小程序码添加图标触发input点击事件
        function fileSelectCode() {
            document.getElementById("fileToUpload_code").click();
        }

        // 选择logo文件后执行的函数
        $("#fileToUpload_code").on("change", function () {
            var file = this.files[0];
            if (window.FileReader) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                //监听文件读取结束后事件
                reader.onloadend = function (e) {
                    var e = e || window.e;
                    // 把加号按钮图片转换成上传的图片
                    // 创建img标签(用于看是否传入的图片过大或过小)
                    var img = $("<img id='img' src=" + e.target.result + ">");
                    setTimeout(function(){
                        var size = $('#fileToUpload_code').get(0).files[0].size;
                        console.log(img);
                        var width = img[0].width;
                        var height = img[0].height;
                        if (width !== 200 || height !== 200) {
                            layer.msg("上传的图片尺寸不等于200px");
                            return;
                        }

                        if (size > 30720) {
                            layer.msg("上传的图片大小不大于30kb");
                            return;
                        }
                        else {
                            $("#pic_code").attr("src", e.target.result); //e.target.result就是最后的路径地址
                            // 让关闭按钮显示
                            $(".code .close").css("display", "block");
                            codeFile = e.target.result;
                        }
                    },200)
                };
            }
        })

        // 点击关闭按钮，关闭选中的logo图片
        $(".code .close").click(function () {
            $("#fileToUpload_code").val('');
            $(".code .close").css("display", "none");
            $(".code>img").attr("src", "{{ asset('statics/wap/v2/image/add.png') }}");
        })

        $(function () {
            // 选择分类点击事件
            $(".choice i").click(function () {
                $("ul").toggleClass("switch");
                if ($(".drop").hasClass("icon-jiantouxia")) {
                    $(".drop").removeClass("icon-jiantouxia").addClass("icon-jiantoushang");
                } else {
                    $(".drop").removeClass("icon-jiantoushang").addClass("icon-jiantouxia");
                }
            })

            // 获取所有的分类
            var classifyArr = [];
            var classifyArrId = [];
            var classify = $(".classify ul");
            var seleSum = 0;
            classify[0].addEventListener('click', addClassify, false);
            // 删除图片
            function addClassify(evt) {
                if (evt.target.tagName.match(/SPAN/)) {
                    var flag = $(evt.target).parent("li").attr("data-flag");
                    if (seleSum >= 3 || (flag && flag == 1)) {
                        return;
                    }

                    $(evt.target).parent("li").attr("data-flag", "1");
                    var text = $(evt.target).text();
                    var index = $(evt.target).parent("li").index();
                    var category_id = $(evt.target).parent("li").attr("data-category_id");
                    var input = $('<input type="text" name="classify" class="inp_select" value=' + text + ' data-category_id=' + category_id +' data-id=' + index + ' style="display: block;">');
                    $("#inp_box").prepend(input);
                    $(evt.target).parent().css("background", "linear-gradient(90deg,rgba(69,230,122,1),rgba(69,230,176,1))");
                    // evt.target.style.background="green";
                    $(evt.target).siblings("img").css("display", "block");
                    seleSum++;
                    var aa = "key" + seleSum;
                    classifyArr.push(String(text));
                    classifyArrId.push(category_id);
                
                    // 修改span中的数字
                    $("#classify_enter").text(seleSum);
                    $("#classify_enter").css({ "font-weight": 600, "color": "#000" });

                } else if (evt.target.tagName.match(/IMG/)) {
                    $(evt.target).parent("li").removeAttr("data-flag");
                    seleSum--;
                    // 把选中的分类改变css并让i隐藏
                    $(evt.target).parent("li").css("background", "#DEDEDE");
                    $(evt.target).css("display", "none");
                    // 获取这个关闭按钮的siblings对应的text值
                    var text = String($(evt.target).siblings("span").text());
                    // 从inp_box中移除value值为text的input
                    $("#inp_box").children("input[value=" + text + "]").remove();
                    // 修改span中字数的变化
                    $("#classify_enter").text(seleSum);
                    $("#classify_enter").css({ "font-weight": 600, "color": "#000" });
                    var removeIndex = classifyArr.indexOf(text);
                    // 从classifyArr数组中删除删除的这个文字
                    classifyArr.splice(removeIndex, 1);
                    classifyArrId.splice(removeIndex, 1);
                }
            }


            $("#submit").click(function () {
                // 获取所需的表单值
                var name = $("#name").val();
                var describe = $("#describe").val();
                var abstract = $("#abstract").val();
                var logo = $("#pic_logo").attr("src");
                var code = $("#pic_code").attr("src");
                var classifyArray = classifyArr;
                var classifyArrIds = classifyArrId;
                var screenshotArr = [];
                var screenshot1 = document.getElementsByClassName("img-thumb");
                for (var i = 0; i < screenshot1.length; i++) {
                    var nature = $(screenshot1[i].innerHTML).attr("src");
                    screenshotArr.push(nature);
                }
                var jsonData = { "name": name, "abstract": abstract, "describe": describe, "logo": logo, "code": code, "classifyArray": classifyArr, "classifyArrId": classifyArrIds, "screenshotArr": screenshotArr };
                // 判断如果有一项没有输入，就提示弹窗
                var bool = true;
                for (k in jsonData) {
                    if (jsonData[k] == null || jsonData[k] == "" || jsonData[k] == undefined) {
                        bool = false;
                        break;
                    }
                }
                if (!bool) {
                    layer.msg("请完整填写表单");
                }
                else {
                    window.name = JSON.stringify(jsonData);
                    window.location.href = "{{ route('wap.apps.preview') }}";
                }

            })
        })

        // 封装最大长度函数
        function maxLength(ele, enter, maxlength) {
            // 当ele输入的时候，计算ele中val的字符串的长度，显示在右侧已经输入的字符数
            var ele = $("#" + ele);
            var enter = $("#" + enter);
            var num = 0;
            var value = "";
            $(ele).on("input", function () {
                value = $(ele).val();
                if (value.length > maxlength) {
                    return;
                }
                if (value.length > 0) {
                    $(enter).css({ "font-Weight": 600, "color": "#666" });
                }
                num = value.length;
                $(enter).text(num);
            })
        }
        // 输入小程序字数变化
        maxLength("name", "name_enter", 10);

        // 输入小程序描述字数变化
        maxLength("describe", "describe_enter", 30);

        // 输入小程序简介字数变化
        maxLength("abstract", "abstract_enter", 200);

        function CheckForm() {
            return false;
        }
    </script>
@endsection