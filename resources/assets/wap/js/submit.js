//图片预览功能
function previewImage(file, imgNum) {
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
function previewImages(file, imgNum) {
        imgNuml++;
        i++
        var MAXWIDTH = 200;
        var MAXHEIGHT = 200;
        var div = document.getElementById('preview' + imgNum);

        if (file.files && file.files[0]) {
                console.log(111)
                var ima = new Array();
                var a = new Array();
                
                var srcp = new Array();;
                // for (i = 1; i <= 6; i++) {
                //         var div = document.getElementById('preview' + imgNum);
                //         ima[i] = document.createElement('img');
                //         ima[i].src = a[i];
                //         div.appendChild(ima[i]);
                // }

             


                var img = document.querySelector(".imgNuml");

                var reader = new FileReader();
                reader.onload = function (evt) {
                        var div = document.getElementById('preview' + imgNum);
                        ima[i] = document.createElement('img');
                        ima[i].setAttribute("class", [i]);
                        srcp[i] = evt.target.result;
                        ima[i].src = srcp[i];
                        div.appendChild(ima[i]);
                       
                }
              
                       
                
                reader.readAsDataURL(file.files[0]);
        } else //
        {
                console.log(222)
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
        console.log(21112)
}

function alkb2() {
        var input = document.getElementById('st19');
        input.click();
        console.log(21112)
}

function alkb3() {
        var input = document.getElementById('st20');
        input.click();
        console.log(21112)
}
function loadImg() {
        //获取文件  
        
        var file = $("#imghead4").find("input")[0].files[0];

        //创建读取文件的对象  
        var reader = new FileReader();

        //创建文件读取相关的变量  
        var imgFile;

        //为文件读取成功设置事件  
        reader.onload = function (e) {
                alert('文件读取完成');
                imgFile = e.target.result;
                console.log(imgFile);
                $("#imgContent").attr('src', imgFile);
        };

        //正式读取文件  
        reader.readAsDataURL(file);
} 