/**
 * ImgUpload
 * @param ele [string] [生成组件的元素的选择器]
 * @param options [Object] [对组件设置的基本参数]
 * options具体参数如下
 * path 图片上传的地址路径 必需
 * onSuccess(res) 文件上传成功后的回调 参数为返回的文本 必需
 * onFailure(res) 文件上传失败后的回调 参数为返回的文本 必需
 * @return [function] [执行图片上传的函数]
 * 调用方法
 * imgUpload('div', options)
 */
function uploadProcess(ele) {
    var arr1 = [];
    // 判断容器元素合理性并且添加基础元素
    var eleList = document.querySelectorAll(ele);

    var screenshotArr = [];
    if (eleList.length == 0) {
        // console.log('绑定的元素不存在');
        return;
    } else if (eleList.length > 1) {
        // console.log('请绑定唯一元素');
        return;
    } else {
        eleList[0].innerHTML = '<div id="img-container" >' +
            '<div class="img-up-add  img-item"> <span class="img-add-icon">+</span> </div>' +
            '<input type="file" name="screenshot" id="img-file-input" multiple>' +
            '</div>';
        var ele = eleList[0].querySelector('#img-container');
        ele.files = [];   // 当前上传的文件数组
        arr1 = ele.files;
    }

    // 为添加按钮绑定点击事件，设置选择图片的功能
    $(".img-up-add").click(function () {
        $("#img-file-input").val("");
        $("#img-file-input").click();
        return false;
    })

    $("#img-file-input").change(handleFileSelect);
    // 预览图片
    //处理input选择的图片
    function handleFileSelect(evt) {
        var thumb = document.getElementsByClassName('thumb-icon');
        var files = evt.target.files;
        //页面上显示的  +  选取的   不能大于5
        // console.log("thumb.length =========" + thumb.length);
        // console.log("files.length =========" + files.length);

        var total = thumb.length + files.length;
        if (total > 5) {
            alert("大于5张");
            return;
        }

        for (var i = 0, f; f = files[i]; i++) {
            // 过滤掉非图片类型文件
            if (!f.type.match('image.*')) {
                continue;
            }
            // 过滤掉重复上传的图片
            var tip = false;
            for (var j = 0; j < (ele.files).length; j++) {
                if ((ele.files)[j].name == f.name) {
                    tip = true;
                    break;
                }
            }
            if (!tip) {
                // 图片文件绑定到容器元素上
                ele.files.push(f);

                var reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        var oDiv = document.createElement('div');
                        oDiv.className = 'img-thumb img-item';
                        // 向图片容器里添加元素
                        oDiv.innerHTML = '<img class="thumb-icon" src="' + e.target.result + '" />' +
                            '<img class="img-remove" src="/statics/wap/v2/image/close.png" alt="">'
                        //    把选择的图片的src装进数组中
                        screenshotArr.push(e.target.result);

                        //大于5张 右边input影藏
                        if (thumb && thumb.length >= 4) {
                            // ele.insertBefore(oDiv, addBtn);
                            $(".img-up-add").css("display", "none");
                            // addBtn.style.display="none";
                        } else {
                            // ele.insertBefore(oDiv, addBtn);
                        }
                        ele.insertBefore(oDiv, $(".img-up-add")[0]);

                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }

        var selectedPic = $("#screenshot_enter");
        selectedPic.text(total);
        selectedPic.css({ "fontWeight": 550, "color": "rgb(102, 102, 102)" });
    }

    $(ele).click(removeImg);
    // 删除图片
    function removeImg(evt) {
        //少于5张  右边的添加input显示
        var thumb = document.getElementsByClassName('thumb-icon');

        if (evt.target.className.match(/img-remove/)) {
            // console.log('3', ele.files);
            // 获取删除的节点的索引
            function getIndex(ele) {
                if (ele && ele.nodeType && ele.nodeType == 1) {
                    var oParent = ele.parentNode;
                    var oChilds = oParent.children;
                    for (var i = 0; i < oChilds.length; i++) {
                        if (oChilds[i] == ele)
                            return i;
                    }
                } else {
                    return -1;
                }
            }
            // 根据索引删除指定的文件对象
            var index = getIndex(evt.target.parentNode);
            ele.removeChild(evt.target.parentNode);
            if (index < 0) {
                return;
            } else {
                ele.files.splice(index, 1);
            }
            if (thumb && thumb.length <= 5) {
                $(".img-up-add").css("display", "block");
            }
        }

        var selectedPic = $("#screenshot_enter");
        selectedPic.text(thumb.length);
        selectedPic.css({ "fontWeight": 550, "color": "rgb(102, 102, 102)" });
    }

    // 上传表单数据和文件
    function upload() {
        // var xhr = new XMLHttpRequest();
        var formData = new FormData();

        // 上传表单数据
        // 小程序名称
        formData.append("name", $("#name").val());
        // 小程序描述
        formData.append("describe", $("#describe").val());
        // 小程序简介
        formData.append("abstract", $("#abstract").val());
        // 小程序logo
        formData.append("logo", $("#fileToUpload_logo")[0].files[0]);
        // 小程序码
        formData.append("code", $("#fileToUpload_code")[0].files[0]);
        // 小程序分类
        var inpSelect = document.getElementsByClassName("inp_select");
        for (var i = 0; i < inpSelect.length; i++) {
            formData.append("classify[]", $(inpSelect[i]).attr("data-id"));
        }
        // 小程序截图
        var screenshot = document.getElementsByClassName("img-thumb");
        for (var i = 0, f; f = ele.files[i]; i++) {
            formData.append('screenshot[]', f);
        }
    }
    return upload;
}

uploadProcess('#upload');