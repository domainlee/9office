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
        items: 2,
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
        margin:0,
        responsive: {
            0: {
                items: 1,
                nav: true,
                margin: 0,
                dots: false,
            },
            640: {
                items: 2,
                nav: true,
                margin: 0,
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
        margin:0,
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
                margin: 0,
                dots: false,
            },
            700: {
                items: 3,
                nav: true,
                margin: 0,
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
        if ( $(this).parsley().isValid() ) {
            button.text('Đang gửi ...');
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
        var email_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('button');
        e.preventDefault();
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
    $(".video__button").modalVideo({allowFullScreen: true});

    $('.pulsation').waypoint(function() {
        $('.pulsation').addClass('animated fadeInUp');
    }, {
        offset: '60%'
    });

    $(window).scroll(function(){
        // if($(this).scrollTop() > 70){
        //     $('body').addClass('head1--fix');
        // }else{
        //     $('body').removeClass('head1--fix');
        // }
        if($(this).scrollTop() > 100){
            $('body').addClass('head--fix');
            $('.head-top').css('display', 'none');
        }else{
            $('body').removeClass('head--fix');
            $('.head-top').css('display', 'block');
        }
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

    $('.btnAddCart').click(function(){

        var products = [], ps = {};
        ps['id'] = $(this).attr('data-id');
        ps['quantity'] = $(this).attr('data-quantity');
        ps['data-color'] = $(this).attr('data-color');
        ps['data-size'] = $(this).attr('data-size');

        products.push(ps);

        addToCart(products, 1, function(rs){
            $('.totalCart').find('span').text(rs.data['totalProducts']);
//            if(rs.status == 1){
            $('#myModal').modal('show');
            $.post('/cart/index', {template: 'order/cart/product', terminal: true},function(r){
                $('#myModal .modal-body').empty().append(r);
                $.getScript(updateCart());
            });
            $.post('/cart/index', {template: 'order/cart/cart-mini', terminal: true},function(r){
                $('.head .cart').empty().append(r);
            });
//            }
        });

        function addToCart(products, mode, callback) {
            $.ajax({
                type: 'POST',
                url: '/cart/add',
                data: {'products': products, 'mode': mode},
                timeout: 500,
                success: function (rs) {
                    callback(rs);
                }
            });
        }
    });
    function updateCart(){

        $('.changeQuantity').change(function(){
            $.post('/cart/change',{
                dataId: $(this).attr('data-id'),
                dataColor: $(this).attr('data-color') ? $(this).attr('data-color'):null,
                dataSize: $(this).attr('data-size') ? $(this).attr('data-size'):null,
                dataQuantity: $(this).find(':selected').text()
            },function(r){
                if(r.code == 0){
                    alert('Chúng tôi không tìm th?y s?n ph?m này');
                }else{
                    $.post('/cart/index', {template: 'order/cart/product', terminal: true},function(r){
                        $('#myModal .modal-body').empty().append(r);
                        $.getScript(updateCart());
                    });
                }
            });
        });

        var hide = true;
        var t = $('.deleteCart');
        var clicks = true;

        t.click(function() {
            var t = $(this);
            var td = t.closest('tr');

            if (clicks) {
                $(this).text('OK');
                $(this).removeClass('fa fa-trash-o');
                clicks = false;
            } else {
                $.post('/cart/remove',{
                    dataId: $(this).attr('data-id'),
                    dataColor: $(this).attr('data-color') ? $(this).attr('data-color'):null,
                    dataSize: $(this).attr('data-size') ? $(this).attr('data-size'):null
                },function(r){
                    if(r.code == 0){
                        alert('We are can not find product on system');
                    }else if(r.code == 1){
                        $.post('/cart/index', {template: 'order/cart/product', terminal: true},function(r){
                            $('#myModal .modal-body').empty().append(r);
                            $.getScript(updateCart());
                        });
                    }
                });
                clicks = true;
            }
        });

        $('html').click(function(e){
            if ($(e.target).hasClass('deleteCart')) {
                return false;
            }
            if(hide){
                t.addClass('fa fa-trash-o').text('');
            }
            clicks = true;
            hide = true;
        });
    };
    $('.btSearch').click(function(){
        $('.formSearch').animate({width:'toggle'},350);
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
});