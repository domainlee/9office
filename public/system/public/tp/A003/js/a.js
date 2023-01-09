$(function(){

    var owl = $(".gallery__slider");
    owl.owlCarousel({
        items: 1,
        nav : true,
        navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        pagination: true,
        singleItem : true,
        animateOut: 'fadeOut',
        stopOnHover : false,
        loop: true
    });

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
        },function(r){
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

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > 1) {
            $("body").addClass("header-fix");
        }else{
            $("body").removeClass("header-fix");
        }
    });

});