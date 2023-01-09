$(function(){

    if($(".landing-client__slider").length) {
        var product = $(".landing-client__slider");
        product.owlCarousel({
            items : 2,
            navigation : false,
            pagination: false,
            singleItem : true,
            transitionStyle : "fade",
            lazyLoad: true,
            autoPlay : 5000,
            stopOnHover : false,
            loop: true
        });
    }

    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };

    $('#readmore').clickToggle(function() {
        $('#readmore').text('Đọc tiếp -');
        $('.more').slideDown();
    },function(){
        $('#readmore').text('Đọc tiếp +');
        $('.more').slideUp();
    });

    $('#btnNav').clickToggle(function() {
        $('.wrapper').animate({left: '-240px'});
        $('.nav').animate({right: '0px'});
        $('.left').animate({left: '-240px'}, 500);
    },function(){
        $('.wrapper').animate({left: '0px'});
        $('.nav').animate({right: '-240px'});
        $('.left').animate({left: '0px'}, 480);
    });

    $(window).scroll(function(){
        if($(window).scrollTop() > 120){
            $('.detailContent').addClass('fixContent');
        }else{
            $('.detailContent').removeClass('fixContent');
        }
    });

    $('#like').click(function(){
        var _this = $(this);
        var id = $(this).attr('data-id');
        var value = $(this).attr('data-type');
        $.post('/home/index/like', {
            id: id,
            data: value
        },function(r) {
            if(r.code == 1){
                _this.addClass('isLike').removeAttr('id').removeAttr('data-id').removeAttr('data-type').attr('title', 'Đã like');
                _this.find('span').empty().text(r.total);
            }else if(r.code == 0){
                alert(r.mes);
            }
        });
    });

    $('.nav>ul>li').each(function(){
        $(this).has('ul').addClass('s');
        if($(this).has('ul')){
            $(this).clickToggle(function() {
                $(this).toggleClass('o');
                $(this).find('ul').slideDown();
            },function(){
                $(this).find('ul').slideUp();
                $(this).toggleClass('o');
            });
        }
    });

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > 1) {
            $("body").addClass("header-fix");
        }else{
            $("body").removeClass("header-fix");
        }
    });

    $('.hero-title, .hero-list, .landing-head-hero__content h2, .landing-head-hero__content h1, .landing-head-hero__content p, .landing-head-hero__content a').waypoint(function() {
        $('.hero-title, .hero-list , .landing-head-hero__content h2, .landing-head-hero__content h1, .landing-head-hero__content p, .landing-head-hero__content a').addClass('animated fadeInUp');
    }, {
        offset: '75%'
    });

    $('.hero-description').waypoint(function() {
        $('.hero-description').addClass('animated fadeInUp');
    }, {
        offset: '75%'
    });

    $('.hero-button_link').waypoint(function() {
        $('.hero-button_link').addClass('animated fadeInUp');
    }, {
        offset: '75%'
    });

    $('.about-title').waypoint(function() {
        $('.about-title').addClass('animated fadeInUp');
    }, {
        offset: '75%'
    });

    $('.about-description_sub').waypoint(function() {
        $('.about-description_sub').addClass('animated fadeInUp');
    }, {
        offset: '75%'
    });

    $('.about-button').waypoint(function() {
        $('.about-button').addClass('animated fadeInUp');
    }, {
        offset: '85%'
    });

    $('.landing-content__item, .pulsation').waypoint(function() {
        $('.landing-content__item').addClass('animated fadeInUp');
        $('.pulsation').addClass('animated fadeInUp');
    }, {
        offset: '60%'
    });


    $('.our-selection__row').waypoint(function() {
        $('.our-selection__row').addClass('animated fadeInUp');
    }, {
        offset: '80%'
    });

    $('.pulsation').waypoint(function() {
        $('.pulsation').addClass('animated fadeInUp');
    }, {
        offset: '80%'
    });

    $('.our-selection__choose-item').waypoint(function() {
        $('.our-selection__choose-item').addClass('animated fadeInRight');
    }, {
        offset: '60%'
    });

    $('.our-selection__choose-img').waypoint(function() {
        $('.our-selection__choose-img').addClass('animated fadeInUp');
    }, {
        offset: '60%'
    });

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $(".video__button").modalVideo({allowFullScreen: true});


    $('.storeRegister').submit(function(e) {
        // var phone_ = $(this).find('input').val();
        var button = $(this).find('button');
        var data = $(this).serialize();
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            button.text('Đang đăng ký ...');
            $.post('/registerajax', data, function (e) {
                if(e.code == 1) {
                    alert('Đăng ký thành công, xin vui lòng kiểm tra email để kích hoạt tài khoản.');
                    location.reload();
                } else if (e.code == 0) {
                    button.text('Đăng ký');
                    alert('Doanh nghiệp đã tồn tại');
                }
            });
        }
    });

    $('.project__button-change').click(function(e){
        e.preventDefault();
        var t = $(this);
        var theme = t.attr('data-theme');
        $('.button-change-template').attr('data-theme', theme).text('Chấp nhận');
        $('#modalGlobal').modal();
    });

    $('.button-change-template').click(function(e){
        e.preventDefault();
        var t = $(this);
        var theme = t.attr('data-theme');
        $.post('/admin/setup/skin', {template: theme}, function (e) {
            if(e.code == 1) {
                t.text('Đổi thành công');
                setTimeout(function(){
                    window.location.href = e.redirect
                }, 2000);
            } else if (e.code == 0) {
                alert('Không tìm thấy');
            }
        });
    });

});