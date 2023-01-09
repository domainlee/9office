$(function(){

    var owl = $(".banner");
    owl.owlCarousel({
        navigation : true,
        pagination: false,
        singleItem : true,
        transitionStyle : "fade",
        navigationText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: true
    });

    var owl = $(".client--slider");
    owl.owlCarousel({
        navigation : true,
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: true
    });

    var owl = $(".gallery__slider");
    owl.owlCarousel({
        navigation : false,
        pagination: true,
        singleItem : true,
        transitionStyle : "fade",
        lazyLoad: true,
        autoPlay : 5000,
        stopOnHover : false,
        loop: true
    });
    $(".last-post__carousel--3").owlCarousel({
        singleItem: false,
        navigation : true,
        pagination: false,
        navigationText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        lazyLoad: true,
        items: 3,
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
    $(".last-post__carousel--4").owlCarousel({
        singleItem: false,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 4,
        margin: 30,
        responsive: {
            0: {
                items: 1,
                nav: false,
                margin: 0,
                dots: false,
            },
            600: {
                items: 4,
                nav: true,
                margin: 30,
                dots: false,
            },
        }
    });
    $('.navigation-button').click(function(){
        $('body').toggleClass('navigation-mobile__js-open');
    });
    $(document).click(function(e) {
        if (!$(e.target).is('.head1 *')) {
            $('.head1').removeClass('navigation-block');
        }
    });

    $(window).scroll(function(){
        if($(this).scrollTop() > 71){
            if($('.head1').hasClass('navigation-block')){
                $('.head1').removeClass('navigation-block');
            }
        }
        if($(this).scrollTop() > 70){
            $('.head').addClass('head1--fix');
        }else{
            $('.head').removeClass('head1--fix');
        }
        if($(this).scrollTop() > 71){
            $('.head').addClass('head--fix');
        }else{
            $('.head').removeClass('head--fix');
        }

    });

    $('.navigation ul li').each(function(){
        var location  = $(this).find('a');
        location.click(function(e){
            $('.navigation ul li a').removeClass('active');
            $(this).addClass('active');
            var scrollTo = $(this).attr('data-href'); // retrieve the hash using .attr()
            if (scrollTo != null && scrollTo != '') {
                $('html, body').animate({
                    scrollTop: $(scrollTo).offset().top-69
                }, 1000);
            }
        });
    });

    $(window).trigger('resize each');

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $(".choose__accordion .choose__accordion--content:not(:first)").hide();
    $(".choose__accordion h3:first").addClass('active');

    $(".choose__accordion h3").click(function(){
        $accordion = $(this).next();
        $(".choose__accordion h3").removeClass('active');
        $(this).addClass('active');

        if ($accordion.is(':hidden') === true) {
            $(".choose__accordion .choose__accordion--content").slideUp();
            $accordion.slideDown();
        } else {
            $accordion.slideUp();
        }
    });

    $('.gallery__button').on('click', function () {
        console.log('a');
        $('.imagepreview').attr('src', $(this).attr('data-url'));
        $('#imagemodal').modal('show');
    });
    $('form').parsley();


    $('.contact__from-right-1').submit(function(e) {
        var title_ = $(this).find('input.title').val();
        var content_ = $(this).find('textarea.content').val();
        var email_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('button');
        e.preventDefault();
        console.log(email_);
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
    $('.contact__from-right-2').submit(function(e) {
        var title_ = $(this).find('input.title').val();
        var content_ = $(this).find('textarea.content').val();
        var email_ = $(this).find('input.email').val();
        var phone_ = $(this).find('input.phone').val();
        var button = $(this).find('button');
        e.preventDefault();
        console.log(email_);
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
    $('.navigation-mobile__list > li > button').click(function() {
        var checkElement = $(this).next().next();
        console.log(checkElement);
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
});