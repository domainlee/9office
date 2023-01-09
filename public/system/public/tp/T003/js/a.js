$(function(){

    var owl = $("#banner");
    owl.owlCarousel({
        items : 1,
        navigation : false,
//        navigationText : ["<i class='fa fa-angle-left'></i>",
//             "<i class='fa fa-angle-right'></i>"],
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: true
    });

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
        responsive: {
            0: {
                items: 2,
                dots: false,
            },
            640:{
                items: 5,
                dots: false,
            }
        }
    });
    var owl = $(".news-slider");
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
        margin: 15,
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
                margin: 15,
                dots: false,
            }
        }
    });
    var owl = $(".slider .banner");
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
            nav : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            pagination: false,
            singleItem : true,
            transitionStyle : "fade",
            lazyLoad: true,
            autoPlay : 5000,
            stopOnHover : false,
            loop: true,
            autoHeight: true,
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
    if ($(window).width() < 640) {
        $('.categoryHome>h2').click(function () {
            $('.navMobile').toggleClass('navMobile__js-open');
        });
    }
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
    $('.btnAddCart, .lAddCard a').click(function(){
        var products = [], ps = {};
        ps['id'] = $(this).attr('data-id');
        ps['quantity'] = $(this).attr('data-quantity');
        ps['data-color'] = $(this).attr('data-color');
        ps['data-size'] = $(this).attr('data-size');

        products.push(ps);

        addToCart(products, 1, function(rs){
            $('.totalCart').find('span').text(rs.data['totalProducts']);
            $('.slide-right__cart').find('span').text(rs.data['totalProducts']);
            $.post('/cart/index', {template: 'order/cart/product', terminal: true},function(r){
                $('.slider-right__content').empty().append(r);
                if($('#zoomer').length) {
                    flyfly({iDrag:$('#zoomer'),position: $('.slide-right__cart')});
                }
                $('body').addClass('slide-right__js-open');
                $.getScript(updateCart());
            });

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
    updateCart();

    function updateCart() {

        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500,
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
                            $('.slider-right__content').empty().append(r);
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
    function flyfly(options){
        var position=options.position,itemDrag=options.iDrag,effect=options.effect;
        if(!effect){
            effect='easeOutExpo';
        }
        if(itemDrag&&position){
            var itemClone=itemDrag.clone()
                .offset({top:itemDrag.offset().top,left:itemDrag.offset().left})
                .css({'opacity':'0.5','position':'absolute','height':itemDrag.width(),'width':itemDrag.height(),'z-index':'999'})
                .appendTo($('body')).
                animate({
                        'top':position.offset().top+5,
                        'left':position.offset().left+5,
                        'width':position.width()-10,
                        'height':position.height()-10},
                    1000,effect
                );
            itemClone.animate({
                'width':0,'height':0
            },function(){
                $(this).detach();
            });
        }
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