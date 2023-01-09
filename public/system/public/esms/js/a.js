// (function ($, root, undefined) {
    $(function(){

        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500
        });

        var owl = $(".banner__js");

        owl.owlCarousel({
            nav : true,
            dots: true,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            autoplay : 100,
            slideSpeed: 100,
            items: 1,
            loop: true,
        });

        var three_slider = $(".three-slider__js");

        three_slider.owlCarousel({
            nav : false,
            dots: true,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            autoplay : 100,
            slideSpeed: 100,
            items: 3,
            loop: true,
            margin: 30,
            responsive:{
                0: {
                    items: 1,
                    nav: false,
                    margin: 15,
                },
                600: {
                    items: 3,
                    nav: true,
                    margin: 20,
                },
                1080: {
                    dots: true,
                    items: 3,
                    nav: false,
                    margin: 20,
                }
            }
        });


        var sync1 = $(".gallery__slider");
        var sync2 = $(".gallery__slider--thumb");
        var slidesPerPage = 1; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            nav : true,
            dots: true,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplayHoverPause: true,
            autoplay : 100,
            lazyLoad: true,
            items: 1,
        });

        sync2
            .on('initialized.owl.carousel', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items : slidesPerPage,
                dots: false,
                nav: true,
                navText: [
                    "",
                    ""
                ],
                smartSpeed: 200,
                slideSpeed : 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate : 100,
                margin: 0
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count-1;
            var current = Math.round(el.item.index - (el.item.count/2) - .5);

            if(current < 0) {
                current = count;
            }
            if(current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if(syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });


        $(".service__carousel").owlCarousel({
            nav : true,
            dots: false,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            autoplay : 100,
            slideSpeed: 200,
            items: 1,
        });

        $(".three-post__list--js").owlCarousel({
            nav : true,
            dots: false,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplay : 100,
            lazyLoad: true,
            items: 3,
            margin: 30,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    margin: 15,
                },
                600:{
                    items: 3,
                    nav: true,
                    margin: 30,
                },
            }
        });

        $(".instagram__list--mobile").owlCarousel({
            nav : false,
            dots: false,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplay : 100,
            lazyLoad: true,
            items: 2,
            margin: 1,
            loop: true,
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

        $(".module-product__carousel").owlCarousel({
            singleItem: false,
            nav: true,
            dots: false,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            items: 5,
            margin: 15,
            responsive:{
                0:{
                    items: 2,
                    nav: false,
                    margin: 15,
                    dots: true,
                },
                600:{
                    dots: true,
                    items: 5,
                    nav: true,
                    margin: 15,
                },
            }
        });
          $(".post-single__slider").owlCarousel({
            nav : false,
            dots: false,
            singleItem : true,
            navText: [
                "",
                ""
            ],
            autoplay : 100,
            lazyLoad: true,
            items: 1,
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

        $(".four-post-1__carousel").owlCarousel({
            singleItem: false,
            nav: false,
            dots: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            items: 1,
        });

        $(".product__list--carousel").owlCarousel({
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
            autoplay : 100,
            loop: true,
            responsive:{
                0:{
                    items:2,
                    nav: false,
                    margin: 15,
                },
                600:{
                    items: 4,
                    nav: false,
                    margin: 30,
                },
            }
        });

        $(".two-news__carousel").owlCarousel({
            singleItem: false,
            nav: true,
            dots: false,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            items: 3,
            margin: 50,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    margin: 0,
                },
                600:{
                    items: 3,
                    nav: false,
                    margin: 50,
                },
            }
        });

        $(".feedback__carousel").owlCarousel({
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
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                    margin: 0,
                },
                600:{
                    items: 3,
                    nav: false,
                    margin: 30,
                },
            }
        });

        $(".five-category__carousel").owlCarousel({
            singleItem: false,
            nav: true,
            dots: false,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            items: 5,
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


        // $(".brand__carousel").owlCarousel({
        //     singleItem: false,
        //     nav: false,
        //     dots: false,
        //     navText: [
        //         "<i class='fa fa-angle-left'></i>",
        //         "<i class='fa fa-angle-right'></i>"
        //     ],
        //     lazyLoad: true,
        //     items: 5,
        //     margin: 30,
        // });

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

        $(".brand__carousel").owlCarousel({
            singleItem: false,
            nav: false,
            dots: false,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            items: 8,
            margin: 15,
            responsive:{
                0:{
                    items: 3,
                    nav: false,
                    margin: 10,
                },
                600:{
                    items: 8,
                    nav:false,
                    margin: 15,
                },
            }
        });

        var owl = $(".created-product__js");

        owl.owlCarousel({
            nav : true,
            dots: true,
            singleItem : true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            lazyLoad: true,
            autoplay : 100,
            slideSpeed: 100,
            items: 1,
            loop: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                },
                600:{
                    items: 1,
                    nav: true,
                },
            }
        });


        $('.head__button-nav').click(function(e){
            $('body').toggleClass('navigation-block');
            e.stopPropagation();
        });

        $('.navigation__mobile--close').click(function(e) {
            $('body').removeClass('navigation-block');
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

        $('ul.sidebar__category > li > a').click(function() {
            var checkElement = $(this).next();
            $('ul.sidebar__category li').removeClass('active');
            $(this).closest('li').addClass('active');
            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                $(this).closest('li').removeClass('active');
                checkElement.slideUp('normal');
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('ul.sidebar__category ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
            }
            if (checkElement.is('ul')) {
                return false;
            } else {
                return true;
            }
        });


        $('ul.checkout__payment--js > li > a').click(function() {
            var checkElement = $(this).next();
            // $('.paymentOption').val($(this).text());
            $('.urlRedirect').val($(this).attr('data-redirect'));

            $('ul.checkout__payment--js li').removeClass('active');
            $(this).closest('li').addClass('active');

            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                $(this).closest('li').removeClass('active');
                checkElement.slideUp('normal');
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('ul.checkout__payment--js ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
            }
            if (checkElement.is('ul')) {
                return false;
            } else {
                return true;
            }
        });

        $('ul.header__navigation--mobile > li > a').each(function(){
            var t = $(this);
            var checkElement = t.next();
            if(checkElement.is('ul')) {
                t.after('<button class="more">+</button>');
                t.next().click(function(e){
                    e.preventDefault();
                    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        checkElement.slideUp('normal');
                    }
                    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        checkElement.slideDown('normal');
                    }
                    // checkElement.slideToggle('normal');
                    $(this).toggleClass('active');

                });
            }

        });

        // $('ul.header__navigation--mobile > li > a').click(function() {
        //     var checkElement = $(this).next();
        //     $('ul.header__navigation--mobile li').removeClass('active');
        //     $(this).closest('li').addClass('active');
        //     if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        //         $(this).closest('li').removeClass('active');
        //         checkElement.slideUp('normal');
        //     }
        //     if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        //         $('ul.header__navigation--mobile ul:visible').slideUp('normal');
        //         checkElement.slideDown('normal');
        //     }
        //     if (checkElement.is('ul')) {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // });

        $('.NavProductOption li a').click(function(){
            var t = $(this);
            $('.NavProductOption li a').removeClass('active');
            $('.tab').removeClass('active');
            $(this).addClass('active');
            $(t.attr('data-tab')).addClass('active');
        });

        // (function(d, s, id) {
        //     var js, fjs = d.getElementsByTagName(s)[0];
        //     if (d.getElementById(id)) return;
        //     js = d.createElement(s); js.id = id;
        //     js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
        //     fjs.parentNode.insertBefore(js, fjs);
        // }(document, 'script', 'facebook-jssdk'));


        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('body').addClass('back-to-top__js');
            } else {
                $('body').removeClass('back-to-top__js');
            }
        });

        $('.backToTop').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });


        $('.button__search').click(function(e){
            e.preventDefault();
            $('body').toggleClass('form__search--js');
        });

        $('.close__search').click(function(e){
            e.preventDefault();
            $('body').removeClass('form__search--js');
        });


        $('.contact__from-right').submit(function(e) {
            // var t = $(this);
            // var name  = t.find('.contact__name').val();
            // var email  = t.find('.contact__email').val();
            // var phone  = t.find('.contact__phone').val();
            // var content  = t.find('.contact__content').val();
            // var url = $('.contact__redirect').val();
            //
            // var modal = $('#checkoutModal');
            //
            // var data = {
            //     'action': 'contact',
            //     'name': name,
            //     'email': email,
            //     'phone': phone,
            //     'content': content,
            // };

            e.preventDefault();
            if ( $(this).parsley().isValid() ) {
                // $.post(ajaxurl, data, function (e) {
                //     var obj = JSON.parse(e);
                //     if(obj.code == 1) {
                //         modal.modal('show');
                //         modal.on('hidden.bs.modal', function () {
                //             window.location.href = url
                //         });
                //     }
                // });
            }
        });

        $('.toggle').click(function(e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.next().hasClass('visible')) {
                $this.next().removeClass('visible');
                $this.next().slideUp(350);
            } else {
                $this.parent().parent().find('li .inner').removeClass('visible');
                $this.parent().parent().find('li .inner').slideUp(350);
                $this.next().toggleClass('visible');
                $this.next().slideToggle(350);
            }
        });

        $('.guide-detail__menu-left').click(function(){
           $('body').toggleClass('body__guide-detail-left-open');
        });





    });
// })(jQuery, this);