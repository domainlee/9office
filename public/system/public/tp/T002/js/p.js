$(function(){
    $('#listImgZoom_2').carouFredSel({
        items: 4,
        easing:'linear',
        height: 435,
        width: '100%',
        duration: 200,
        direction: "up",
        scroll: {
            items: 1,
            visible: true,
            duration: 200,
            onAfter: function( data ) {
                data.items.visible.first().find('img').addClass('cloudzoom-gallery-active');
            }
        },
        auto: false,
        prev : {
            button : "#prevSlideZ",
            key : "left"
        },
        next : {
            button : "#nextSlideZ",
            key : "right"
        }
    });

    if ($('#zoomer').length) {
        CloudZoom.quickStart();
    }

    $('#QttDown').click(function () {
        var qtt = $('#Quantity'), m = parseInt(qtt.attr('data-max')), v = parseInt(qtt.attr('data-value'));
        if (v > 1) {
            qtt.attr('data-value', v - 1);
            qtt.html(v - 1);
            $('.btnAddCart').attr('data-quantity',v - 1);
        }
    });
    $('#QttUp').click(function () {
        var qtt = $('#Quantity'), m = parseInt(qtt.attr('data-max')), v = parseInt(qtt.attr('data-value'));
        if (v < m) {
            qtt.attr('data-value', v + 1);
            qtt.html(v + 1);
            $('.btnAddCart').attr('data-quantity',v + 1);
        }
    });

    $('.attrColor a').click(function(){
        $('.attrColor a').removeClass('active');
        $(this).addClass('active');
        $('.btnAddCart').attr('data-color',$(this).attr('data-attr'));
    });

    $('.attrSize a').click(function(){
        $('.attrSize a').removeClass('active');
        $(this).addClass('active');
        $('.btnAddCart').attr('data-size',$(this).attr('data-attr'));
    });



    $('.detailPayorder>div').click(function(){
         var t = $(this);
        if(!t.hasClass('active')){
            $('.detailPayorder>div').removeClass('active');
            $('.detailPayorder>div>div').slideUp();
            $('.detailPayorder>div').find('i').removeClass('fa-caret-down').addClass('fa-caret-right');

        }
        t.find('div').slideDown();
        t.addClass('active');
        $(this).find('i').removeClass('fa-caret-right').addClass('fa-caret-down');
    });

});