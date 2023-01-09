$(function(){

    $(".banner").owlCarousel({
        items: 1,
        singleItem: true,
        nav: false,
        dots: true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        loop: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                margin: 0,
                dots: true,
            },
        }
    });
    $('.banner').on('translated.owl.carousel', function(event) {
        $(this).find(".banner-image > div > p").addClass('animated fadeInUp');
    });
    $('.banner').on('translate.owl.carousel', function(event) {
        $(this).find(".banner-image > div > p").removeClass('hidden animated fadeInUp');
    });
    $('.banner').on('translated.owl.carousel', function(event) {
        $(this).find(".banner-image > div > h3").addClass('animated fadeInUp');
    });
    $('.banner').on('translate.owl.carousel', function(event) {
        $(this).find(".banner-image > div > h3").removeClass('hidden animated fadeInUp');
    });
    $('.banner').on('translated.owl.carousel', function(event) {
        $(this).find(".banner-image > div > a").addClass('animated zoomIn');
    });
    $('.banner').on('translate.owl.carousel', function(event) {
        $(this).find(".banner-image > div > a").removeClass('hidden animated zoomIn');
    });

    var owl = $(".two-up__product-list");
    owl.owlCarousel({
        items: 4,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        margin:30,
        responsive: {
            0: {
                items: 2,
                nav: true,
                margin: 15,
                dots: false,
            },
            640: {
                items: 2,
                nav: true,
                margin: 15,
                dots: false,
            },
            700: {
                items: 4,
                nav: true,
                margin: 30,
                dots: false,
            },
        }
    });
    var owl = $(".news-slider");
    owl.owlCarousel({
        items: 3,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        margin:30,
        responsive: {
            0: {
                items: 1,
                nav: true,
                margin: 0,
                dots: false,
            },
            600: {
                items: 2,
                nav: true,
                margin: 15,
                dots: false,
            },
            700: {
                items: 3,
                nav: true,
                margin: 30,
                dots: false,
            },
        }
    });
    var owl = $(".gallery-slider");
    owl.owlCarousel({
        items: 5,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        margin:30,
        responsive: {
            0: {
                items: 2,
                nav: true,
                margin: 15,
                dots: false,
            },
            640: {
                items: 4,
                nav: true,
                margin: 15,
                dots: false,
            },
            700: {
                items: 5,
                nav: true,
                margin: 30,
                dots: false,
            },
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

    // $('img.lazy').lazyload({
    //     effect: "fadeIn",
    //     threshold: 200
    // });

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

//    $('.lP li').sizeChanged(function(e){
//        console.log(e.width());
//    });
//    $(window).resize(function() {
//        var max = -1;
//        var t = $('.lP li');
//        t.each(function(){
//            var h = $(this).height();
//            max = h > max ? h : max;
//        });
//    });
//    $(window).resize(function(){
//        $('#banner').sizeChanged(function(){
//            console.log($(this).height());
//        });

//        console.log(max);
//    });
//
//    $(window).trigger('resize');

    $('.navigation-mobile__list > li > a').click(function() {
        var checkElement = $(this).next();
        $('.navigation-mobile__list li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('.navigation-mobile__list ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });


    $('.open-sidebar').click(function(){
        $('.productCategory').toggleClass('sidebar__js-open');
    });
    $('body').click(function () {
        var $this = $(this);
        $this.removeClass('form-search__js-open');
    });
    $('.button__nav-menu').click(function(){
        $('body').toggleClass('navigation-mobile__js-open');
    });
    $('.contact__from-right').submit(function(e) {
        var title_ = $(this).find('input.title').val();
        var content_ = $(this).find('textarea.content').val();
        var email_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('button');
        e.preventDefault();
        console.log(email_);
        if ( $(this).parsley().isValid() ) {
            button.text('Sending ...');
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
    $('.support__form').submit(function(e) {
        var title_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('input.button').val();
        e.preventDefault();
        console.log(email_);
        if ( $(this).parsley().isValid() ) {
            button.text('Đang gửi...');
            $.post('/contactajax', {'email' : email_, 'phone': phone_}, function (e) {
                if(e.code == 1) {
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    location.reload();
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });
    $('.gallery__list li').click(function () {
        var img = $(this).attr('img');
        $('#galleryModal .modal-body').empty().append('<figure class="lazy gallery__image" style="background-image: url('+img+')"></figure>');
        $('#galleryModal').modal('show');
    });


    $('.gallery-slider li').click(function () {
        var img = $(this).attr('img');
        $('#galleryModal .modal-body').empty().append('<figure class="lazy gallery__image" style="background-image: url('+img+')"></figure>');
        $('#galleryModal').modal('show');
    });
    $('ul.categoryProduct > li > a').click(function() {
        var checkElement = $(this).next();
        $('ul.categoryProduct li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('ul.categoryProduct ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });
    $('ul.nav2 > li > a').click(function() {
        var checkElement = $(this).next();
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

});