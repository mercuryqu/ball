$(document).ready(function () {
    // 弹出层start
    $(".mack").hide();
    $(".mack_top").hide();
    var offheight = $(window).height();
    var offwidth = $(window).width();
    var offwidth2 = $(window).width() / 2;
    $(".conten_con_fx").hide()

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

    $(document).on("scrollstop", function () {
        alert("停止滚动!");
    });



    $(document).on("scrollstart", function () {
        alert("开始滚动!");
    });
    $(document).scroll(function () {

        var poo = $(document).scrollTop();
        if (poo > 200) {

            $(".fext").fadeIn("300");
        }
        if (poo < 200) {

            $(".fext").hide();
        }

    });


    $(".Recommend_er_dwon").on("click", function () {
        $(".Recommend_er_list").slideToggle()
        return false;
    });
    //下划线
    $(".list").on("click", function (e) {
        var x = event.clientX;
        var talp = e.delegateTarget;
        $(".list").removeClass("lopk")
        $(talp).addClass("lopk")
        return false;
    });
    $(".lists").on("click", function (e) {
         $(".Recommend_er_list").hide()
        var talp = e.delegateTarget.attributes[1].nodeValue;
        var lopl = document.querySelectorAll('[data-ng-bind]')[talp];
        console.log(talp)
        var x = event.clientX + offwidth2;
        console.log(x)
          console.log(offwidth2)
           if (talp <=4) {
               $(".iccmcont").animate({
                   right: 0
               });
           }
         else  {
           $(".iccmcont").animate({
               right: x
           });
        }
      
        
        $(".list").removeClass("lopk")
        $(lopl).addClass("lopk")




        return false;
    });
})