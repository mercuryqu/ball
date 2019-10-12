//图片预览功能
var images = [];
function previewImage(file, imgNum, filed) {
    var file = filed;

    var MAXWIDTH = 200;
    var MAXHEIGHT = 200;
    var div = document.getElementById('preview' + imgNum);

    if (file.files && file.files[0]) {
        div.innerHTML = '<img id=imghead' + imgNum + '>';
        var img = document.getElementById('imghead' + imgNum + '');
        img.onload = function () {
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            // img.width  =  rect.width;
            // img.height =  rect.height;
            //         img.style.marginLeft = rect.left+'px';
            // img.style.marginTop = rect.top+'px';
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            img.src = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
    } else //
    {
        var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead' + imgNum + '>';
        var img = document.getElementById('imghead2');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        //     var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        //     status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead" + imgNum + sFilter + src + "\"'></div>";
    }
}

var imgNuml = 1;
var i = 1;
var filelist=[]
function previewImages(file, imgNum) {
    console.log(filelist)
    if(filelist.length>2){
        layer.msg("展示图数量不能超过三张！");
        return false;
    }
    imgNuml++;
    i++
    var MAXWIDTH = 200;
    var MAXHEIGHT = 200;
    var div = document.getElementById('preview' + imgNum);

    if (file.files && file.files[0]) {
        var ima = new Array();
        var a = new Array();

        var srcp = new Array();
        var img = document.querySelector(".imgNuml");

        var reader = new FileReader();
        reader.onload = function (evt) {
            var div = document.getElementById('preview' + imgNum);
            ima[i] = document.createElement('img');
            ima[i].setAttribute("class", [i]);
            srcp[i] = evt.target.result;
            ima[i].src = srcp[i];
            div.appendChild(ima[i]);
            var image = document.querySelector("#st20").files[0];
            images.push(image);
            filelist.push(image)
        }
        reader.readAsDataURL(file.files[0]);
    } else //
    {

        var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead' + imgNum + '>';
        var img = document.getElementById('imghead2');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        //     var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        //     status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead" + imgNum + sFilter + src + "\"'></div>";
    }
}

function clacImgZoomParam(maxWidth, maxHeight, width, height) {
    var param = {
        top: 0,
        left: 0,
        width: width,
        height: height
    };
    if (width > maxWidth || height > maxHeight) {
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if (rateWidth > rateHeight) {
            param.width = maxWidth;
            param.height = Math.round(height / rateWidth);
        } else {
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }
    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}


function alkb1() {
    var input = document.getElementById('st18');
    input.click();

}

function alkb2() {
    var input = document.getElementById('st19');
    input.click();

}

function alkb3() {
    var input = document.getElementById('st20');
    input.click();

}

var result = document.getElementById("st18");
var file = document.getElementById("bot");

//判断浏览器是否支持FileReader接口
function readAsBinaryString() {
    var file = document.getElementById("file").files[0];
    var reader = new FileReader();
    //将文件以二进制形式读入页面
    reader.readAsBinaryString(file);
    reader.onload = function (f) {
        var result = document.getElementById("result");
        //显示文件
        result.innerHTML = this.result;
    }
}

function readAsText() {
    var file = document.getElementById("file").files[0];
    var reader = new FileReader();
    //将文件以文本形式读入页面
    reader.readAsText(file);
    reader.onload = function (f) {
        var result = document.getElementById("result");
        //显示文件
        result.innerHTML = this.result;
    }
}

var categories = [];

$(document).ready(function () {
    // 小程序分类start
    var spans = [];

    var hove = 0;
    $(".divinprtlist").slideUp();
    $(".Recommend_er_dwon").on("click", function () {
        if (hove != 1) {
            $(".Recommend_er_dwon").addClass("hove");
            hove = 1;
        } else {
            $(".Recommend_er_dwon").removeClass("hove");
            hove = 0;
        }
        categories = [];
        $(".divinprtlist").slideToggle();
        for (i = 0; i < spans.length; i++) {
            var spanliss = spans[i].dataset.pop;
            categories.push(spanliss)
        }

        $('input[name="categories"]').val('');
        var category=categories+"";
        console.log(category)
        $('input[name="categories"]').val(category);
    });


    $(".divinprtlist>span").on("click", function (e) {
        // console.log(spans)
        var tager = e.target
        for (var i = 0; i < spans.length; i++) { //删除相同的
            if (spans[i] === this) {
                spans.splice(i, 1);
                $(this).removeClass("spansolid");
                return;
            }
        }
        if (spans.length < 3) {
            $(this).addClass("spansolid");
            spans.push(this)
        } else {
            layer.msg("最多选择三个标签")
        }
    })

})