// show app's code
function show_code(code_name, code_url)
{  $("body").css("overflow","hidden")
    $(".mack").fadeIn();
    $(".mack_top").slideDown();
    $(".miniapp-code").attr('src', code_url);
    $("#app-name").text(code_name);
    // return false;
}

// add csrf token to ajax request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function app_list(id, logo, name, slogan, code)
{
    var html = '<div class="napes">';
    html += '<a target="_top" href="/apps/' + id + '">';
    html += '<div class="nape_lefts">';
    html += '<img class="logo-img" src="' + logo + '">';
    html += '</div>';
    html += '</a>';
    html += '<div class="nape_rights_spam clearfix">';
    html += '<a target="_top" href="/apps/' + id + '">';
    html += '<div class="nape_rights">';
    html += '<h6 class="limit-name">' + name + '</h6>';
    html += '<p class="limit-name">' + slogan + '</p>';
    html += '</div>';
    html += '</a>';
    html += '<span class="macks" onclick="show_code(\'' + name + '\', \'' + code + '\')">体验</span>';
    html += '</div>';
    html += '</div>';
    return html;
}

// 微信分享
function wechat_share(wechat_share_config, wechat_share_obj)
{
    // wechat share config
    wx.config({
        debug: false,
        appId: wechat_share_config.appId,
        timestamp: wechat_share_config.timestamp,
        nonceStr: wechat_share_config.nonceStr,
        signature: wechat_share_config.signature,
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });

    var img = wechat_share_obj.imgUrl ? wechat_share_obj.imgUrl : '/statics/wap/favicon.ico';

    wx.ready(function() {
        wx.onMenuShareTimeline({
            title: wechat_share_obj.title + ' - 小程序 - 球小栈', // 分享标题
            desc: wechat_share_obj.desc,
            link: window.location.href, // 分享链接
            imgUrl: wap_base_url + img, // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                layer.msg("分享成功");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                layer.msg("您已取消分享");
            }
        });
        wx.onMenuShareAppMessage({
            title: wechat_share_obj.title + ' - 小程序 - 球小栈', // 分享标题
            desc: wechat_share_obj.desc,
            link: window.location.href, // 分享链接
            imgUrl: wap_base_url + img, // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                layer.msg("分享成功");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                layer.msg("您已取消分享");
            }
        });
    });
}

$(document).ready(function () {
    $(".fext").hide();
    $(".mack").hide();
    $(".mack_top").hide();
    $(".conten_con_fx").hide();

    var offheight = $(window).height();
    $(".mack").css("height", offheight + "px");
    $(".macks").on("tap", function () {
        $("body").css("overflow","hidden")
        $(".mack").fadeIn();
        $(".mack_top").slideDown();
        return false;
    });

    $(".mack").on("tap", function () {
        $(".mack").fadeOut();
        $(".mack_top").slideUp();
        return false;
    });
    $(".mack").on("click", function () {
        $("body").css("overflow","auto")
        $(".mack").fadeOut();
        $(".mack_top").slideUp();
        return false;
    });

    $("#keyword").focus(function () {//隐藏底部 防止浏览器把网页缩小
        $(".mack_li").hide();
    });
    $("#keyword").blur(function () {
        $(".mack_li").show();
    });

    // global back to referrer page
    $('.back-referrer').on('click', function ()
    {
        document.referrer === '' ? window.location.href = wap_base_url : window.history.go(-1);
    });
});

window.onload=function(){
    if(document.documentElement.scrollHeight <= document.documentElement.clientHeight) {
        bodyTag = document.getElementsByTagName('body')[0];
        bodyTag.style.height = document.documentElement.clientWidth / screen.width * screen.height + 'px';
    }
    setTimeout(function() {
        window.scrollTo(0, 1)
    }, 0);
};

$(document).scroll(function () {
    var poo = $(document).scrollTop();
  
    if (poo >100) {

        $(".fext").fadeIn("300");
    }
   else if (poo <100) {

        $(".headline").show();
        $(".fext").hide();
    }
});
