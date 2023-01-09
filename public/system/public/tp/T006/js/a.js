$(function(){
    var owl = $("#banner");
    var owl_sync = $("#banner-custom-dots");

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
        owl_sync.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items : 4,
            stopOnHover : true,
            smartSpeed: 200,
            slideSpeed : 500,
            slideBy: 1,
            responsiveRefreshRate : 100,
            responsive: {
                300: {
                    items: 2,
                },
                640:{
                    items: 3,
                },
                800: {
                    items: 4
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

    $('.slide-right__inner a').click(function() {
        $('body').toggleClass('slide-right__js-open');
    });

    $('.categoryHome>h2').click(function () {
       $('body').toggleClass('nav__js-open');
    });

});