$(function(){
    var owl = $(".banner");
    owl.owlCarousel({
        items: 1,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: false,
    });

    var client__slider = $(".client__slider");
    client__slider.owlCarousel({
        items: 1,
        nav : false,
        navText : ["", ""],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        loop: true
    });

    var product__slider = $(".hot-product__list");
    product__slider.owlCarousel({
        items: 1,
        nav : true,
        navText: ["", ""],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        loop: true,
    });
    var product__slider = $(".tab-product");
    product__slider.owlCarousel({
        items: 4,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        loop: false,
        margin: 30,
        responsive: {
            0: {
                items: 1,
                margin: 0,
                dots: false,
                nav: true,
            },
            600: {
                items: 2,
                dots: false,
                nav: true,
                margin: 30,
            },
            800: {
                items: 4,
                dots: false,
                nav: true,
                margin: 30,
            },
        }
    });
    var product__slider = $(".news-slider");
    product__slider.owlCarousel({
        items: 3,
        nav : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 500,
        stopOnHover : false,
        loop: false,
        margin:30,
        responsive: {
            0: {
                items: 1,
                margin: 0,
                dots: false,
                nav: true,
            },
            600: {
                items: 2,
                margin: 30,
                dots: false,
                nav: true,
            },
            800: {
                items: 3,
                margin: 30,
                dots: false,
                nav: true,
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

    $('.head__buttonMenu').click(function () {
        $('body').toggleClass('head__js-navigation-open');
    });
    $('.open-sidebar').click(function(){
        $('body').toggleClass('sidebar__js-open');
        $('.opacity-filter').toggleClass('opacity-filter--true');
        $("i", this).toggleClass("fa-arrow-right fa-arrow-left");
    });
    $('#menuMobile').click(function(){
        $('.navMobile').toggleClass('open');
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

    // $(window).scroll(function() {
    //     var scroll = $(window).scrollTop();
    //     if (scroll >= 30) {
    //         $("body").addClass("fix-header1");
    //     } else {
    //         $("body").removeClass("fix-header1");
    //     }
    // });

    $('.backToTop').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 700);
    });
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
    $('ul.categoryProduct > li > button').click(function() {
        var checkElement = $(this).next().next();
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
    }

});