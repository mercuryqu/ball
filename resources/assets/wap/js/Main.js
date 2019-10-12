$(document).ready(function () {
    // getbaicaijiaTitle();

    function getbaicaijiaTitle() {
        $.ajax({
            dataType: 'jsonp',
            jsonp: "callback",
            url: "http://ball.iokvip.com/wap/apps/hot?page=2&per_page=8",
            success: function (data) {
                console.log(data)
                // var data = data.data;
                var html = template('test', data);
                $('.box').html(html)
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
            }
        })
    }

    $(".mack").hide();
    $(".mack_top").hide();
    var offheight = $(window).height();
    var offwidth = $(window).width();
    var offtop = $(".Recommendnew").offset().top-72;
    console.log(offtop)
    var Re = $(".Recommendnew").outerWidth();
    var Rer = $(".Recommendnew").outerHeight();
    $(".conten_con_fx").hide()
    console.log(Rer)
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
    $(".Recommend_cont").on("taphold", function () {
        $(".Recommend_cont").addClass("divc");
    });
    $(".mack").on("click", function () {

        $(".mack").fadeOut()
        $(".mack_top").slideUp();
        return false;
    });

    $(".napes").on("click", function () {


        return false;
    });

    $("#Recommend_cont").fadeOut();
    $(".conten_con_fx").on("click", function () {
        $("#Recommend_cont").parent().nextAll().show();
        $("#Recommend_cont").parent().prevAll().show();
        $(".conten_con_fx").hide()
        $("#Recommend_cont").css("top", offtop + 'px');
        $("#Recommend_cont").hide(0);
        $("#Recommend_cont").animate({
            top: offtop + "px",
            left: 0,
            height: Rer + 'px',
            width: '100%',
            zIndex: 1000,
            opacity: '0',
        }, "fast", clackshow());
        return false;
    });


    $("#Recommend_cont").css("width", Re + "px")
    $("#Recommend_cont").css("top", offtop + "px")
    $(".Recommendnew").click(function () {
        $(".conten_con_fx").show()
        $("#Recommend_cont").css("top", "0px")
   
        $("#Recommend_cont").show();
        $("#Recommend_cont").animate({

            left: 0,
            height: offheight + 'px',
            width: offwidth + "px",
            zIndex: 1000,
            opacity: '1',

        }, "fast", clack());

    });

    function clack(params) {
        $("body").css("background", "#f3f2f2")
        $(".Recommendnew").removeClass("divc");
        $(".lpo").addClass("divc");
        $(".headline").hide();
        $("#Recommend_cont").prevAll().hide();
        $("#Recommend_cont").parent().nextAll().hide();
        $("#Recommend_cont").parent().prevAll().hide();
    }

    function clackshow(params) {
        $("body").css("background", "#fff")
        $(".Recommendnew").addClass("divc");
        $(".lpo").removeClass("divc");
        $(".headline").show();
        $("#Recommend_cont").prevAll().show();
        $("#Recommend_cont").parent().nextAll().show();
        $("#Recommend_cont").parent().prevAll().show();
        $('html, body').animate({
            scrollTop: offtop
        }, 'slow');
    }
    var config = {
        "top": 0,
        "left": 0,
        "zIndex": 2,
        "height": offheight
    }

    // var arrow = document.getElementById("Recommend_cont");

    // $("#Recommend_cont").on("click", function () {
    //      animate(arrow, config, function () {});
    // });





    function animate(obj, json, fn) {
        clearInterval(obj.timer);
        obj.timer = setInterval(function () {
            var flag = true;
            for (var k in json) {
                if (k === "opacity") {
                    var leader = getStyle(obj, k) * 100;
                    var target = json[k] * 100;
                    var step = (target - leader) / 1000;
                    step = step > 0 ? Math.ceil(step) : Math.floor(step);
                    leader = leader + step;
                    obj.style[k] = leader / 100;
                } else if (k === "zIndex") {
                    obj.style.zIndex = json[k];
                } else {
                    var leader = parseInt(getStyle(obj, k)) || 0;
                    var target = json[k];
                    var step = (target - leader) / 0.35;
                    step = step > 0 ? Math.ceil(step) : Math.floor(step);
                    leader = leader + step;
                    obj.style[k] = leader + "px";
                }
                if (leader != target) {
                    flag = false;
                }
            }
            if (flag) {
                clearInterval(obj.timer);
                if (fn) {
                    fn();
                }
            }
        }, 0.1);
    }

    function getStyle(obj, attr) {
        if (window.getComputedStyle) {
            return window.getComputedStyle(obj, null)[attr];
        } else {
            return obj.currentStyle[attr];
        }
    }
    
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
            console.log(poo)
            $(".headline").hide();
            $(".fext").fadeIn("300");
        }
        if (poo < 200) {
            console.log(poo)
            $(".headline").fadeIn("300");
            $(".fext").hide();
        }

    });

   

  
});