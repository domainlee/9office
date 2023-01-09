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

    $('.btnAddCart').click(function(){

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
                flyfly({iDrag:$('#zoomer'),position: $('.slide-right__cart')});
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
        }}




});