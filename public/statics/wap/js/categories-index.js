$(document).ready(function () {
    // 弹出层start
    var loplplp = $(".iccmcont>span").length + $(".iccmcont>span").length * 0.3
    $(".iccmcont").css("width", loplplp + "rem")


    var offheight = $(window).height();
    var offwidth = $(window).width();
    var offwidth2 = $(window).width() / 2;
    $(".conten_con_fx").hide()



  

    var lop = 1;
    $(".Recommend_er_dwon").on("click", function () {
        if (lop == 1) {
            $(".Recommend_er_dwon>img").addClass("hove")
            $(".Recommend_er_list").slideToggle()
            lop = 2;
            return;
        } else if (lop == 2) {
            $(".Recommend_er_dwon>img").removeClass("hove");
            $(".Recommend_er_list").slideToggle()
            lop = 1;
            return;
        }


        return false;
    });
    //下划线
    $(".list").on("click", function (e) {
        var x = event.clientX;
        var talp = e.delegateTarget;
        $(".list").removeClass("lopk");
        $(talp).addClass("lopk")
        return false;
    });

    var al = 0;
    var bl = []
    $(".lists").on("click", function (e) {
        al++;
        var lists = $(".list").outerWidth()
        $(".Recommend_er_list").hide()
        lop = 1;
        $(".Recommend_er_dwon>img").removeClass("hove");
        var talp = e.delegateTarget.attributes[1].nodeValue;
        var lopl = document.querySelectorAll('[data-ng-bind]')[talp - 1];

        bl[al] = $(lopl).offset().left
        var x = lists * talp;

        if (talp <= 5) {
            $(".lccm").animate({
                scrollLeft: 0
            }, 'slow');
        }
        else {
            $(".lccm").animate({
                scrollLeft: x
            }, 'slow');
        }
        $(".list").removeClass("lopk")
        $(lopl).addClass("lopk")
        return false;
    });
})