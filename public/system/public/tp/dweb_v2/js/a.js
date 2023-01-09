$(function(){

    if($(".landing-client__slider").length) {
        var product = $(".landing-client__slider");
        product.owlCarousel({
            items : 1,
            // navigation : true,
            // pagination: true,
            // singleItem : true,
            // transitionStyle : "fade",
            // lazyLoad: true,
            // autoPlay : true,
            // stopOnHover : false,
            // loop: true,
            // dots: false,
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

    $(".video__button").modalVideo({allowFullScreen: true, autoplay: 1});


    $('.storeRegister').submit(function(e) {
        // var phone_ = $(this).find('input').val();
        var button = $(this).find('button');
        var data = $(this).serialize();
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            button.text('Đang đăng ký ...');
            console.log(data);
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

    $('.created-website__form-js').submit(function(e) {
        var button = $(this).find('button');
        var data = $(this).serialize();
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            // button.text('Đang đăng ký ...');
            $.post('/created', data, function (e) {
                if(e.code == 1) {
                    location.reload();
                } else if (e.code == 0) {
                    var _modal = $('#modalGlobal');
                    _modal.modal();
                    var _content = _modal.find('.modal-content p');
                    _content.html(e.messenger)
                }
            });
        }
    });

    if($('.theme__left--inner').length) {
        var headTop = $('.theme__left--inner').offset().top;
        var footerTop = $('.footer').offset().top;
        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if (scroll >= headTop && scroll < (footerTop - 500)) {
                $('body').addClass('sidebar__js');
            } else {
                $('body').removeClass('sidebar__js');
            }
        });
    }

    $('.contactForm__js').submit(function(e) {
        e.preventDefault();
        var t = $(this);
        var button = t.find('button');
        var data = $('.contactForm__js').serialize();
        if ( $(this).parsley().isValid() ) {
            button.text('Đang gửi...');
            console.log(data);
            $.post('/contactajax', data, function (e) {
                if(e.code == 1) {
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    location.reload();
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });

    $(".question-answer__title").click(function() {
        if ($('.question-answer__content').is(':visible')) {
            $(".question-answer__content").slideUp(300);
            $(".question-answer__title").removeClass('question-answer__title--active');
        }
        if ($(this).next(".question-answer__content").is(':visible')) {
            $(this).next(".question-answer__content").slideUp(300);
            $(this).removeClass('question-answer__title--active');
        } else {
            $(this).next(".question-answer__content").slideDown(300);
            $(this).addClass('question-answer__title--active');
        }
    });

    $('.header__button--mobile a').click(function(){
       $('body').toggleClass('header__js--active');
    });

    var label_price = $('.form-submit__require--price span');
    var label_price_renew = $('.form-submit__require--price-year span');
    var form_price = $('.price');
    var form_content = $('.content');

    function updateTextArea() {
        var allVals = 0;
        var allVals_renew = 0;

        var service = '';
        $('.form-submit__require--item input:checked').each(function() {
            var price = parseFloat($(this).val());
            allVals = parseFloat(allVals + price);
            service += $(this).attr('data-title')+' | ';
        });

        $('.form-submit__require--item input.renew:checked').each(function() {
            var price = parseFloat($(this).val());
            allVals_renew = parseFloat(allVals_renew + price);
        });

        label_price.text(number_format(allVals));
        label_price_renew.text(number_format(allVals_renew));
        form_price.val(allVals);
        form_content.val(service);
    }

    $(function() {
        $('.form-submit__require--item input').click(updateTextArea);
        updateTextArea();
    });

    function number_format (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            // }
            // if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }





});