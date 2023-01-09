$(function(){
    var owl = $("#banner");
    var owl_sync = $(".banner-custom-dots");

    owl.owlCarousel({
        items : 1,
        // nav : true,
        // dots: true,
        // navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoplay : 2500,
        stopOnHover : true,
        loop: true
    }).on('changed.owl.carousel', syncBanner);

    owl_sync.on('initialized.owl.carousel', function () {
        owl_sync.find(".owl-item figure").each(function () {
            $(this).css("background-image", "url('" + $(this).data('src') + "')");
        });
        owl_sync.find(".owl-item").eq(0).addClass("current");
    })
        .owlCarousel({
            items : 5,
            stopOnHover : true,
            smartSpeed: 200,
            slideSpeed : 500,
            slideBy: 1,
            margin: 5,
            responsiveRefreshRate : 100,
            responsive: {
                300: {
                    items: 3,
                },
                640:{
                    items: 4,
                },
                800: {
                    items: 5
                }
            }
        }).on('changed.owl.carousel', syncBannerDot);

    function syncBanner(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count-1;
        var current = Math.round(el.item.index - (el.item.count/2) - .5);

        if(current < 0) {
            current = count;
        }
        if(current > count) {
            current = 0;
        }
        //end block

        owl_sync
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = owl_sync.find('.owl-item.active').length - 1;
        var start = owl_sync.find('.owl-item.active').first().index();
        var end = owl_sync.find('.owl-item.active').last().index();

        if (current > end) {
            owl_sync.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            owl_sync.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncBannerDot(el) {
        if(true) {
            var number = el.item.index;
            owl.data('owl.carousel').to(number, 100, true);
        }
    }

    owl_sync.on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).index();
        owl.data('owl.carousel').to(number, 300, true);
    });


    if($("#product").length) {
        var product = $("#product");
        product.owlCarousel({
            items : 1,
            navigation : false,
            pagination: false,
            singleItem : true,
            transitionStyle : "fade",
            lazyLoad: true,
            autoPlay : 500,
            stopOnHover : false,
            loop: false
        });
    }

    if($(".small-banner__list").length) {
        var small_banner = $(".small-banner__list");
        small_banner.owlCarousel({
            items : 6,
            singleItem : true,
            transitionStyle : "fade",
            lazyLoad: true,
            autoplay : 3000,
            stopOnHover : false,
            loop: true,
            responsive:{
                300: {
                    items: 3,
                },
                640:{
                    items: 4,
                },
                800: {
                    items: 5
                }
            },
        })
    }

    var owl_product = $(".product-slider");
    owl_product.owlCarousel({
        items: 4,
        nav : true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        stopOnHover : true,
        // loop: true,
        margin:30,
        responsive: {
            0: {
                items: 2,
                nav: true,
                margin: 0,
                dots: false,
            },
            640:{
                items: 4,
                nav: true,
                margin: 30,
                dots: false,
            }
        }
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

    $('.sidebar-home__tab-product-title li a').click(function(){
        var t = $(this);
        $('.sidebar-home__tab-product-title li a').removeClass('active');
        $('.tabProductSidebar').removeClass('active');
        $(this).addClass('active');
        $(t.attr('data-tab')).addClass('active');
    });

    $('.slide-right__inner a').click(function() {
        $('body').toggleClass('slide-right__js-open');
    });

    $('.categoryHome>h2').click(function () {
       $('body').toggleClass('nav__js-open');
    });

    $('.nav>ul>li>span.icon-caret').click(function () {
        if($(this).parent().hasClass('mobile--active')){
            $(this).parent().removeClass('mobile--active');
        }
        else{
            $('.nav>ul li').removeClass('mobile--active');
            $(this).parent().addClass('mobile--active');
        }
    });

    $('.nav>ul>li>ul>li>span.icon-caret').click(function () {
        if($(this).parent().hasClass('mobile--active')){
            $(this).parent().removeClass('mobile--active');
        }
        else{
            $('.nav>ul>li>ul li').removeClass('mobile--active');
            $(this).parent().addClass('mobile--active');
        }
    });
});