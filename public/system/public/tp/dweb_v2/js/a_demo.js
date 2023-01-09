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

    $('#demo-iframe body').scroll(function() {
        var scroll = $('#demo-iframe body').scrollTop();
        if (scroll > 1) {
            $("body").addClass("header-fix");
        }else{
            $("body").removeClass("header-fix");
        }
    });

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });



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


});