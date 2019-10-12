$(document).ready(function () {
    // 弹出层start
    $(".mack").hide();
    $(".mack_top").hide();
    var offheight = $(window).height();
    var offwidth = $(window).width();

    // $(".conten_con_fx").hide()

    $(".mack").css("height", offheight + "px")
    $(".macks").on("tap", function () {
        $(".mack").fadeIn();
        $(".mack_top").slideDown();
        return false;

    });
    $(".macks").on("click", function () {
        $(".mack").fadeIn();
        $(".mack_top").slideDown();
        return false;
    });
    $(".mack").on("tap", function () {
        $(".mack").fadeOut()
        $(".mack_top").slideUp();
        return false;
    });
    $(".mack").on("click", function () {

        $(".mack").fadeOut()
        $(".mack_top").slideUp();
        return false;
    });
    // 弹出层end
    var conten_conh = $(".conten_con").outerHeight();
    $(document).on("scrollstop", function () {
        alert("停止滚动!");
    });



    $(document).on("scrollstart", function () {
        alert("开始滚动!");
    });
    $(document).scroll(function () {

        var poo = $(document).scrollTop();
        if (poo > 200) {
            $(".headline").hide();
            $(".fext").fadeIn("300");
        }
        if (poo < 200) {
            $(".headline").fadeIn("300");
            $(".fext").hide();
        }

    });

})