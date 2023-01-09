$(function(){

    $(".banner").owlCarousel({
        items: 1,
        singleItem: true,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true
    });
    var owl = $(".product-slider");
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
        margin: 30,
        responsive: {
            0: {
                items: 1,
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
        margin: 30,
        responsive: {
            0: {
                items: 1,
                nav: true,
                margin: 0,
                dots: false,
            },
            640:{
                items: 3,
                nav: true,
                margin: 30,
                dots: false,
            }
        }
    });
    $('form').parsley();


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


    $('ul.categoryProduct > li > button').click(function() {
        var checkElement = $(this).next().next();
        console.log(checkElement);
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
    $('ul.news__list-category > li > button').click(function() {
        var checkElement = $(this).next().next();
        console.log(checkElement);
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
    $('#menuMobile').click(function(){
        $('.navMobile').toggleClass('open');
    });
    $('ul.mobile-navHome__list > li > button').click(function() {
        var checkElement = $(this).next().next();
        $('ul.mobile-navHome__list li').removeClass('active');
        $(this).closest('li').addClass('active');
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('ul.mobile-navHome__list ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;
        }
    });
    $('.navMobile > ul > li > button').click(function() {
        var checkElement = $(this).next().next();
        console.log(checkElement);
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
    $('.open-sidebar').click(function(){
        $('body').toggleClass('sidebar__js-open');
        $('.opacity-filter').toggleClass('opacity-filter--true');
        $("i", this).toggleClass("fa-arrow-right fa-arrow-left");
    });
    $('.open-search').click(function (e) {
        e.stopPropagation();
        $('body').toggleClass('form-search__js-open');
    });
});