$(function(){

    var owl = $("#banner");
    owl.owlCarousel({
        items: 1,
        nav : false,
        navText : ["", ""],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoplay : 100,
        stopOnHover : false,
        loop: true
    });

    var owl = $(".client__slider");
    owl.owlCarousel({
        items: 1,
        nav : false,
        navText : ["", ""],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        loop: true
    });

    var owl = $(".four-post__slider");
    owl.owlCarousel({
        items: 1,
        nav : false,
        navText : ["", ""],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoplay : 200,
        stopOnHover : false,
        loop: true
    });


    var owl = $(".gallery__slider");
    owl.owlCarousel({
        items: 1,
        nav : true,
        navText : ["", ""],
        pagination: true,
        singleItem : true,
        animateOut: 'fadeOut',
        stopOnHover : false,
        loop: true
    });

    var owl = $(".feature-project__list");
    owl.owlCarousel({
        items: 3,
        nav : false,
        navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoplay : 200,
        stopOnHover : false,
        loop: true,
        margin: 30,
        responsive: {
            0: {
                items: 1,
                nav: false,
                margin: 0,
                dots: false,
            },
            600: {
                items: 3,
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

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $('.btSearch').click(function(){
        $('.formSearch').animate({width:'toggle'},350);
    });

//    $('.navMobile>ul>li>a').click(function() {
//        var checkElement = $(this).next();
//        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
//            checkElement.slideUp('normal');
//        }
//        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
//            $('ul.categorySidebar ul:visible').slideUp('normal');
//            checkElement.slideDown('normal');
//        }
//        if (checkElement.is('ul')){
//            return false;
//        } else {
//            return true;
//        }
//    });

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

    $('.navigation-button').click(function(){
        $('body').toggleClass('navigation-mobile__js-open');
    });

    $('.open-search').click(function (e) {
        e.stopPropagation();
        $('body').toggleClass('form-search__js-open');
    });

    $('body').click(function () {
        var $this = $(this);
        $this.removeClass('form-search__js-open');
    });

    $("#search").click(function (e) {
        e.stopPropagation();
    });

    $('.form__register').submit(function(e) {
        var email_ = $(this).find('input.email');
        var phone_ = $(this).find('input.phone');
        var button = $(this).find('button');
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            button.text('Sending ...');
            $.post('/contactajax', {'email': email_.val(), 'phone': phone_.val()}, function (e) {
                if(e.code == 1) {
                    button.text('Gửi');
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    email_.val('');
                    phone_.val('');
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });

    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('body').addClass('head--fix');
        }else{
            $('body').removeClass('head--fix');
        }
    });


});