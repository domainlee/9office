$(function(){

    var owl = $("#banner");
    owl.owlCarousel({
        nav : true,
        dots: false,
        singleItem : true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        autoPlay : 100000,
        items: 1,
    });

    $("#last-post__carousel").owlCarousel({
        singleItem: true,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 2,
        margin: 30,
    });

    $(".post-course__carousel").owlCarousel({
        singleItem: false,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 3,
        margin: 20,
    });

    $(".news-event__carousel").owlCarousel({
        singleItem: false,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 3,
        margin: 20,
    });

    $(".learn-think__carousel").owlCarousel({
        singleItem: false,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 2,
        margin: 20,
    });


    $(".product-home__carousel").owlCarousel({
        singleItem: false,
        nav: true,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 3,
        margin: 30,
    });


    $(".brand__carousel").owlCarousel({
        singleItem: false,
        nav: false,
        dots: false,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        lazyLoad: true,
        items: 5,
        margin: 30,
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
        loop: true,
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
        loop: true,
        items: 1,
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

    /*console.log($('.main__category').height());

    var mainCategory = $('.main__category');
    var heightCategory = mainCategory.height()/2;
    mainCategory.css({'height': heightCategory+280});*/
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
    $('ul.news__list-category > li > i').click(function() {
        var checkElement = $(this).next().next();
        $('ul.news__list-category > li').removeClass('active');
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
    $('ul.nav2 > li > i').click(function() {
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
});