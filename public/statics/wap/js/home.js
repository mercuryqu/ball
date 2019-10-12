$(function () {
    var page = 1;
    $('body').dropload({
        scrollArea: window,
        domUp: {
            domClass: 'dropload-up',
            domRefresh: '<div class="dropload-refresh">↓下拉刷新</div>',
            domUpdate: '<div class="dropload-update">↑释放加载</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>数据加载中...</div>'
        },
        domDown: {
            domClass: 'dropload-down',
            domRefresh: '<div class="dropload-refresh">↑上拉加载更多</div>',
            domLoad: '<div class="dropload-load"><span class="loading"></span>数据加载中...</div>',
            domNoData: '<div class="dropload-noData">没有更多啦！</div>'
        },

        loadDownFn: function (me) {
            $.ajax({
                type: 'GET',
                url: home_ajax_url,
                data: {'page': page},
                dataType: 'text',
                success: function (data) {
                    page++;
                    if (data == '') {
                        me.lock();
                        me.noData();
                    }
                    $('.conten_con').append(data);
                    click_large();
                    me.resetload();
                },
                error: function (xhr, type) {
                    layer.msg('数据加载错误!');
                    me.resetload();
                }
            });
        },
        threshold: 100,
        distance: 50
    });
});

function click_large() {

    $(".swiper-wrapper").css("transform","translate3d(0px, 0px, 0px)");

    var mySwiper6 = new Swiper('.horse.swiper-container', {
        slidesPerView: 1.05,
    });
    var mySwiper = new Swiper('.horse_race_lamp', {
        speed: 2500,

        slidesOffsetAfter: 20,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            waitForTransition: false
        },

        slidesPerView: 4.5, //'auto'
        onTransitionEnd: function (swiper) {
            if (swiper.progress == 1) {
                swiper.activeIndex = swiper.slides.length - 1
            }
        },
        observer: true,//修改swiper自己或子元素时，自动初始化swiper
        observeParents: false,//修改swiper的父元素时，自动初始化swiper
        onSlideChangeEnd: function (swiper) {
            mySwiper.update();
            mySwiper.startAutoplay();
            mySwiper.reLoop();
        }
    });

    // 封装点击放大的动画
    var linit = 0;
    var indexes = 3; //删除第几个索引后面的所有数据
    var offheight = $(window).height(); //屏幕高度
    var doheight = $(document).height();
    var conten_con_imgssctop = 1;
    $(".conten_con_imgss").on("click", function (e) {
        var mackse = $.trim("macks");
        var etager = $.trim(e.target.className);
        if (mackse == etager) {
            return false;
        }

        var doctop = window.pageYOffset;
        var napeslist = $(this).find('.napes')[indexes];

        conten_con_imgssctop = $(this).offset().top; //被卷曲的高度

        if (linit == 0) {
            var napess = $(this).find('.napes');
            for (var i = 0; i < napess.length; i++) {
                napess[i].remove()
            }
            $("body").css("overflow", "hidden");
            $(this).removeClass("rehovers");
            $(this).addClass("hovers");
            linit = 1;

            var module_id = $(this).find('.conten_con_imgss').prevObject[0].dataset.id;
            show_type_apps(module_id, 'click');
            return;
        } else if (linit == 1) {
            $("body").css("overflow", "auto");
            if ($(this).find('.napes').length > 4) {
                $(napeslist).nextAll().remove()
            }

            if ((doctop + $(this).height() / 2) > (doheight - offheight)) {
                $('html, body').animate({
                    scrollTop: conten_con_imgssctop + $(this).height()
                }, 'slow');
            } else {
                $('html, body').animate({
                    scrollTop: conten_con_imgssctop
                }, 'slow');
            }
            $(this).removeClass("hovers");
            $(this).addClass("rehovers");
            linit = 0;
        }
    })
}


function show_type_apps(module_id, type) {
    var module_apps_ajax_url = '/wap/modules/' + module_id + '/apps';
    if (module_apps_ajax_url.length > 0) {
        $.get(module_apps_ajax_url, function (data) {
            var module = '#module_' + module_id;
            $(module).append(data);
            if (type != 'click') {
                module_apps_ajax_url = data.next_page_url ? data.next_page_url : '';
            }
        });
    }
}