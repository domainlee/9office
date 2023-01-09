$(function(){

    $("#banner").owlCarousel({
        items: 1,
        singleItem: true,
        nav: true,
        dots: false,
        navText: [
//            "<i class='fa fa-angle-left'></i>",
//            "<i class='fa fa-angle-right'></i>"
        ]
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

//    $('#readmore').clickToggle(function() {
//        $('#readmore').text('Đọc tiếp -');
//        $('.more').slideDown();
//    },function(){
//        $('#readmore').text('Đọc tiếp +');
//        $('.more').slideUp();
//    });

    $('.categoryHome>ul>li>a').click(function(){
        var a = $(this);
        var next = $(this).next();
        next.slideToggle(function(){
            $(this).closest('li').toggleClass('open', $(this).is(':visible'));
            if($(this).is(':visible')){
                next.prev().find('span').text('Thu gọn');
            }else{
                next.prev().find('span').text('Nhấn để xem');
            }
        });
        if(next.is('ul')){
            return false;
        }else{
            return true;
        }
    });

});