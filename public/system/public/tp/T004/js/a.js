$(function(){

    var owl = $("#banner");
    owl.owlCarousel({
        items : 1,
        navigation : false,
//        navigationText : ["prev", "next"],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: true
    });

    if($("#product").length) {
        var product = $("#product");
        product.owlCarousel({
            items : 1,
            navigation : true,
            pagination: false,
            singleItem : true,
            transitionStyle : "fade",
            lazyLoad: true,
            autoPlay : 5000,
            stopOnHover : false,
            loop: true,
            autoHeight:true,
        });
    }

    var owl = $(".product-slider");
    owl.owlCarousel({
        items: 4,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : true,
        loop: true,
        margin:30,
        responsive: {
            0: {
                items: 2,
                margin: 15,
                dots: false,
            },
            640:{
                items: 4,
                margin: 30,
                dots: false,
            }
        }
    });


    var owl = $(".lP");
    owl.owlCarousel({
        navigation : true,
        navigationText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        pagination: false,
//        singleItem : true,
        items : 5,
//        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : true,
        loop: true
    });

    var fsearch = $('form#search'), search = $('form#search input[name="q"]');
//    var searchType = $('form#search .selectType p span');

    search.autocomplete({
        source: function () {
            var s = $('#searchFolding');
            s.slideDown();
            $.post(fsearch.attr('action') + '?q=' + search.val() + '&limit=20',
                {template: 'suggestion', terminal: 1},
                function (data) {
                    s.html(data);
                }
            );
        }
    });

    search.keyup(function () {
        if (!$(this).val().length) {
            $('#searchFolding').slideUp();
        }
    }).focus(function () {
            if ($(this).val().length) {
                $('#searchFolding').slideDown();
            }
        }).focusout(function () {
            $('#searchFolding').slideUp();

    });

    $.fn.sizeChanged = function (handleFunction) {
        var element = this;
        var lastWidth = element.width();
        var lastHeight = element.height();

        setInterval(function () {
            if (lastWidth === element.width()&&lastHeight === element.height())
                return;
            if (typeof (handleFunction) == 'function') {
                handleFunction({ width: lastWidth, height: lastHeight },
                    { width: element.width(), height: element.height() });
                lastWidth = element.width();
                lastHeight = element.height();
            }
        }, 100);


        return element;
    };

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $('.nav>ul>li').hover(function(){
        $('.nav>ul>li').removeClass('active');
        $(this).addClass('active');
    });

    $('.NavProductOption li a').click(function(){
        var t = $(this);
        $('.NavProductOption li a').removeClass('active');
        $('.tab').removeClass('active');
        $(this).addClass('active');
        $(t.attr('data-tab')).addClass('active');
    });

    $('.ADsHome1 ul li a').hover(function(){
        $('.ADsHome1 ul li a').removeClass('active');
        $(this).addClass('active');
    });

    $('.slide-right__inner a').click(function() {
        $('body').toggleClass('slide-right__js-open');
    });
    $('.category').each(function (e) {
        var i = e+1;
       $(this).addClass('category' + i);
    });
    $(window).bind('resizeEnd', function() {
        bannerHeight = $(".NavBannerAds #banner").height();
        console.log(bannerHeight);
        $(".home .nav").css("height",bannerHeight+10);
        console.log($(".home .nav").height());
        console.log("done");
    });
    $('.navMobile > ul > li > button').click(function() {
        var checkElement = $(this).next().next();
        $('.navMobile > ul li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('.navMobile > ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });
    $('ul.news__list-category > li > button').click(function() {
        var checkElement = $(this).next().next();
        $('ul.news__list-category li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('ul.news__list-category ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });
    $('ul.nav2 > li > button').click(function() {
        var checkElement = $(this).next().next();
        $('ul.nav2 li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('ul.nav2 ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });
    if ($(window).width() < 640) {
        $('.categoryHome>h2').click(function () {
            $('.navMobile').toggleClass('navMobile__js-open');
        });
    }
    $('form').parsley();

    $('.contact__from-right').submit(function(e) {
        var title_ = $(this).find('input.title').val();
        var content_ = $(this).find('textarea.content').val();
        var email_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('button');
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            button.text('Đang gửi...');
            $.post('/contactajax', {'name': title_, 'content': content_, 'email' : email_, 'phone': phone_}, function (e) {
                if(e.code == 1) {
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    location.reload();
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });
});