$(function(){

    $('.form-order').submit(function(e) {
        var t = $(this);
        var label = $('.form-success');
        var name  = t.find('.form-name').val();
        var phone  = t.find('.form-phone').val();
        var address  = t.find('.form-address').val();
        var email = t.find('.form-email').val();
        var product  = t.find('.form-product').val();
        var name_product  = t.find('.confirm-order').attr('data-name');
        var name_quantity  = t.find('.confirm-order').attr('data-quantity');
        var name_color  = t.find('.confirm-order').attr('data-color');
        var name_size  = t.find('.confirm-order').attr('data-size');


        var note = t.find('.form-note').val();
        var product = t.find('.form-product').val();
        var product_price = t.find('.form-product-price').val();
        var data = {
            'action': 'order',
            'name': name,
            'phone': phone,
            'address': address,
            'size': name_size,
            'color': name_color,
            'quantity': name_quantity,
            'product':product,
            'email':email,
            'price':product_price,
            'note':note
        };
        var modal = $('#successModal');
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post(ajaxurl, data, function (e) {
                t.find('.form-name').val('');
                t.find('.form-phone').val('');
                t.find('.form-address').val('');
                t.find('.form-note').val('');
                t.find('.form-email').val('');
                /*label.fadeIn(10);*/
                /*setTimeout(function(){
                    label.fadeOut();
                }, 6000);*/
                setTimeout(function(){
                    $('#modalOrder').modal('hide');
                }, 10);
                $('#successModal').modal('show');
                setTimeout(function(){
                    $('#successModal').modal('hide');
                }, 8000);
            });
        }
    });

    $('.add-cart').click(function (e) {
        var t = $(this);
        var post_id  = t.attr('data-id');
        var name_quantity  = t.attr('data-quantity');
        var name_color  = t.attr('data-color');
        var name_size  = t.attr('data-size');
        var data = {
            'action': 'add_cart',
            'post_id': post_id,
            'size': name_size,
            'color': name_color,
            'quantity': name_quantity,
        };
        e.preventDefault();
        $.post(ajaxurl, data, function (e) {
            $('.cart-modal__inner').empty().append(e);
        });
    });
    

    $('.remove-cart').click(function (e) {
        var data = {
            'action': 'remove_cart',
        };

        e.preventDefault();
        $.post(ajaxurl, data, function (e) {
        });
    });

    var hide = true;
    var t = $('.deleteCart');
    var clicks = true;

    t.click(function() {
        var t = $(this);
        var data = {
            'action': 'remove_cart',
            'id' : t.attr('data-id'),
        };

        if (clicks) {
            $(this).text('OK');
            $(this).removeClass('fa fa-trash-o');
            clicks = false;
        } else {
            $.post(ajaxurl, data ,function(r){
                location.reload();
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

    $('#QttDown').click(function () {
        var qtt = $('#Quantity'), m = parseInt(qtt.attr('data-total-quantity')), v = parseInt(qtt.attr('data-value'));
        if (v > 1) {
            qtt.attr('data-value', v - 1);
            qtt.html(v - 1);
            $('.btn-order-now').attr('data-quantity',v - 1);
        }
    });

    $('#QttUp').click(function () {
        var qtt = $('#Quantity'), m = parseInt(qtt.attr('data-total-quantity')), v = parseInt(qtt.attr('data-value'));
        if (v < m) {
            qtt.attr('data-value', v + 1);
            qtt.html(v + 1);
            $('.form-order__button button').attr('data-quantity',v + 1);
            $('.btn-order-now').attr('data-quantity',v + 1);
        }
    });

    $('.product-single__color a').click(function(){
        $('.product-single__color a').removeClass('active');
        $(this).addClass('active');
        $('.form-order__button button').attr('data-color',$(this).attr('data-value'));
        $('.btn-order-now').attr('data-color',$(this).attr('data-value'));
    });

    $('.product-single__size a').click(function(){
        $('.product-single__size a').removeClass('active');
        $(this).addClass('active');
        $('.form-order__button button').attr('data-size',$(this).attr('data-attr'));
        $('.btn-order-now').attr('data-size',$(this).attr('data-value'));
    });

    $('.product-single__material select').change(function() {
        var value = $(this).find(':selected').attr('data-value');
        var weight = $(this).find(':selected').attr('data-weight');
        $('.btn-order-now').attr('data-material', value).attr('data-weight', weight);
        $('.product-single__weight').html('<label>Trọng lượng</label><strong>'+(weight ? weight+' g':'0')+'</strong>');
    });

    if ($('#listImgZoom_2').length) {
        $('#listImgZoom_2').carouFredSel({
            items: 4,
            easing: 'linear',
            height: 350,
            width: 80,
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
    }

    if ($('#zoomer').length) {
        CloudZoom.quickStart();
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
        }
    }

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

    
    function loadScriptFilter() {
        $('.brand-category__list li a').click(function (e) {
            var t = $(this);
            var url  = t.attr('data-query');
            var slug  = t.attr('data-slug');
            var append  = $('.append-content');

            var data = {
                'action': 'filter_taxonomy',
                'url': url,
                'slug': slug,
            };

            e.preventDefault();
            $.post(ajaxurl, data, function (e) {
                append.html(e);
                $.getScript(loadScriptFilter());
            });
        });

        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500
        });
    }

    $('.order-product').click(function(e){
        e.preventDefault();
        var t = $(this);
        var name = t.attr('data-name');
        var totalQuantity = t.attr('data-total-quantity');
        var quantity = t.attr('data-quantity');
        var color = t.attr('data-color');
        var material = t.attr('data-material');
        var weight = t.attr('data-weight');
        var id = t.attr('data-id') + (color ? '_'+color:'') + (material ? '_'+material:'') + (weight ? '_'+weight:'');

        var image = t.attr('data-image');
        var price = t.attr('data-price');
        var redirect = t.attr('data-redirect');

        $.shoppingcart('add', {
            'id': id,
            'image': image,
            'name': name,
            'code': '000',
            'url': 'http://dweb.vn',
            'color': color,
            'material': material,
            'weight': weight,
            'price': price,
            'priceOff': 0,
            'count': quantity,
            'totalQuantity': totalQuantity
        });
        window.location.href = redirect;
    });


    $('.order-product__addcart').click(function(e){
        e.preventDefault();

        $('body').addClass('cart-open__js');

        var t = $(this);
        var name = t.attr('data-name');
        var totalQuantity = t.attr('data-total-quantity');
        var quantity = t.attr('data-quantity');
        var color = t.attr('data-color');
        var material = t.attr('data-material');
        var weight = t.attr('data-weight');
        var id = t.attr('data-id') + (color ? '_'+color:'') + (material ? '_'+material:'') + (weight ? '_'+weight:'');

        var image = t.attr('data-image');
        var price = t.attr('data-price');
        var redirect = t.attr('data-redirect');

        $.shoppingcart('add', {
            'id': id,
            'image': image,
            'name': name,
            'code': t.attr('data-id'),
            'url': 'http://dweb.vn',
            'color': color,
            'material': material,
            'weight': weight,
            'price': price,
            'priceOff': 0,
            'count': quantity,
            'totalQuantity': totalQuantity
        });

        $.getScript(htmlSingle());
    });

    $('.product-single__cart-btn-close').click(function(e){
        e.preventDefault();
        $('body').removeClass('cart-open__js');
    });

    function removeCart() {
        var _buttonRemove = $('.sale__button-remove');
        _buttonRemove.click(function () {
            var _dataId = $(this).attr('data-id');
            console.log(_dataId);
            $.shoppingcart('remove',{'id': _dataId});
            $.getScript(htmlCart());
        });
    }

    $('.template-cart__btn-remove-cart').click(function () {
        $.shoppingcart('clear');
        $.getScript(htmlCart());
    });


    function changeQuantity() {
        $('.changeQuantity').change(function(){
            var id = $(this).attr('data-id');
            var quantity = $(this).find(':selected').text();
            $.shoppingcart('edit', {
                'id': id,
                'count': quantity,
            });
            $.getScript(htmlCart());
        });
    }
    
    htmlCart();

    function htmlCart() {
        var cart_html = $('.cart__inner--html');
        var total_price = $('.template-cart__total');

        var cartProduct = $.shoppingcart('getAll');
        if(cartProduct) {
            var item = '';
            var totalMoney = 0;
            $.each(cartProduct, function (index, value) {
                var option = '';
                for(i = 1; i <= value.totalQuantity ;i++) {
                    option += '<option value="'+i+'" '+ ( i == value.count ? 'selected':null ) +'>'+i+'</option>';
                }
                totalMoney += (value.price - value.priceOff) * value.count;
                item += '<tr>' +
                    '<td style="vertical-align: middle"><figure data-src="'+value.image+'" class="cart__image lazy"></figure></td>'+
                    '<td style="vertical-align: middle">'+value.name+'</td>'+
                    '<td style="vertical-align: middle">'+( value.color ? '<span class="cart__color" style="background-color: '+value.color+'"></span>':'')+'</td>'+
                    '<td style="vertical-align: middle">'+(value.material ? value.material:'')+'</td>'+
                    '<td style="vertical-align: middle">'+(value.weight ? value.weight:'')+'</td>'+
                    '<td style="vertical-align: middle"><b>'
                    +number_format(value.price)+' đ'+
                    '</b></td>'+
                    '<td style="vertical-align: middle">'+
                    '<select data-id="'+value.id+'" class="form-control changeQuantity">'+option+'</select>'+
                    '</td>'+
                    '<td style="vertical-align: middle"><b>'+number_format((value.price - value.priceOff) * value.count)+' đ</b></td>'+
                    '<td style="text-align: center;vertical-align: middle"><a data-id="'+value.id+'" class="sale__button-remove table-action-btn"><i class="fa fa-trash-o"></i></a></td>'+
                    '</tr>';
            });

            total_price.html(number_format(totalMoney)+ '<span>vnđ</span>');

            cart_html.html(item);
            $('.lazy').Lazy({
                effect: "fadeIn",
                effectTime: 500
            });
            $.getScript(changeQuantity(),removeCart());
        }
    }

    htmlCheckout();

    function htmlCheckout() {
        var checkout = $('.checkout__inner--html');

        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500
        });
        var cartProduct = $.shoppingcart('getAll');
        if(cartProduct) {
            var item = '';
            var totalMoney = 0;
            $.each(cartProduct, function (index, value) {
                var option = '';
                for(i = 1; i <= value.totalQuantity ;i++) {
                    option += '<option value="'+i+'" '+ ( i == value.count ? 'selected':null ) +'>'+i+'</option>';
                }
                totalMoney += (value.price - value.priceOff) * value.count;
                item += '<div class="checkout__product--item">' +
                    '<div><figure class="lazy checkout__thumbnail" data-src="'+value.image+'"></figure></div>'+
                    '<div><h3 class="checkout__product--title">'+value.name+'</h3>'+( value.color ? '<p class="checkout__color">Màu: <span style="background-color: '+value.color+'"></span></p>':'')+(value.material ? '<p class="checkout__material">Chất liệu: '+value.material+'</p>':'')+(value.weight ? '<p class="checkout__weight">Trọng lượng: '+value.weight+'</p>':'')+'<p class="checkout__quantity">Số lượng: <span>'+value.count+'</span></p></div>'+
                    '<div class="checkout__product--price"><b>'+number_format((value.price - value.priceOff) * value.count)+' đ</b></div>'+
                    '</div>';
            });
            item += '<div class="checkout__coupon"><form><input type="text" placeholder="Mã giảm giá" /><button>Sử dụng</button></form></div>'
            item += '<div class="checkout__price--draft"><div>Tạm tính: <div><strong>'+number_format(totalMoney)+'</strong><span>vnđ</span></div></div><div>Phí vận chuyển</div></div>';
            item += '<div class="checkout__total"><div>Tổng: <div><strong>'+number_format(totalMoney)+'</strong><span>vnđ</span></div></div></div>'
            checkout.html(item);
            $('.payment_now').attr('data-price', totalMoney);

        }
    }

    htmlSingle();

    function htmlSingle() {
        var cartSingle = $('.product-single__cart--inner');

        var cartProduct = $.shoppingcart('getAll');
        if(cartProduct) {
            var item = '<div class="product-single__cart--list">';
            var totalMoney = 0;
            $.each(cartProduct, function (index, value) {
                var option = '';
                for(i = 1; i <= value.totalQuantity ;i++) {
                    option += '<option value="'+i+'" '+ ( i == value.count ? 'selected':null ) +'>'+i+'</option>';
                }
                totalMoney += (value.price - value.priceOff) * value.count;
                item += '<div class="checkout__product--item">' +
                    '<div><figure class="lazy checkout__thumbnail" data-src="'+value.image+'"></figure></div>'+
                    '<div><h3 class="checkout__product--title">'+value.name+'</h3>'+( value.color ? '<p class="checkout__color">Màu: <span style="background-color: '+value.color+'"></span></p>':'')+(value.material ? '<p class="checkout__material">Chất liệu: '+value.material+'</p>':'')+(value.weight ? '<p class="checkout__weight">Trọng lượng: '+value.weight+'</p>':'')+'<p class="checkout__quantity">Số lượng: <span>'+value.count+'</span></p>'+
                    '<div class="checkout__product--price"><b>'+number_format((value.price - value.priceOff) * value.count)+' đ</b></div></div>'+
                    '</div>';
            });
            item += '</div><div class="checkout__total"><div>Tổng: <div><strong>'+number_format(totalMoney)+'</strong><span>vnđ</span></div></div></div>'
            cartSingle.html(item);
        }

        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500
        });
    }

    $('.checkout__form-payment').submit(function(e) {
        var t = $(this);
        var name  = t.find('.checkout__name').val();
        var email  = t.find('.checkout__email').val();
        var phone  = t.find('.checkout__phone').val();
        var address  = t.find('.checkout__address').val();
        var payment  = $('.paymentOption').val();
        var orderId  = $('.orderId').val();
        var cartProduct = $.shoppingcart('getAll');

        var urlRedirect  = $('.urlRedirect').val();

        var modal = $('#checkoutModal');

        var data = {
            'action': 'order',
            'orderId': orderId,
            'name': name,
            'email': email,
            'phone': phone,
            'address': address,
            'payment': payment,
            'data': cartProduct,
            'redirect': urlRedirect,
        };

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            if(cartProduct){
                $.post(ajaxurl, data, function (e) {
                    var obj = JSON.parse(e);
                    if(obj.code == 1) {
                        $.shoppingcart('clear');
                        if(obj.redirect == 1) {
                            window.location.href = obj.urlRedirect;
                        } else if(obj.redirect == 0) {
                            modal.modal('show');
                            modal.on('hidden.bs.modal', function () {
                                window.location.href = urlRedirect
                            });
                        }
                    }
                });
            }
        }
    });


    $('.form-contact').submit(function(e) {
        var t = $(this);
        var name  = t.find('.contact__name').val();
        var email  = t.find('.contact__email').val();
        var phone  = t.find('.contact__phone').val();
        var content  = t.find('.contact__content').val();
        var url = $('.contact__redirect').val();

        var modal = $('#checkoutModal');

        var data = {
            'action': 'contact',
            'name': name,
            'email': email,
            'phone': phone,
            'content': content,
        };

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post(ajaxurl, data, function (e) {
                var obj = JSON.parse(e);
                if(obj.code == 1) {
                    modal.modal('show');
                    modal.on('hidden.bs.modal', function () {
                        window.location.href = url
                    });
                }
            });
        }
    });

    $('.order-custom__color--item').click(function(){
        $('.order-custom__color--item').removeClass('active');
        $(this).addClass('active');
    });

    $('.form-custom-order').submit(function(e) {
        var t = $(this);
        var name  = t.find('.order-custom__name').val();
        var birthday  = t.find('.order-custom__birthday').val();
        var email  = t.find('.order-custom__email').val();
        var phone  = t.find('.order-custom__phone').val();
        var address  = t.find('.order-custom__address').val();
        var description  = t.find('.order-custom__description-order').val();

        var product = $('.order-custom__product').find(':selected').attr('value');
        var price = $('.order-custom__price').find(':selected').attr('value');
        var meterial = $('.order-custom__meterial').find(':selected').attr('value');
        var color = $('.order-custom__color--item.active').attr('data-color');
        var url = $('.urlReload').val();
        var modal = $('#checkoutModal');

        var data = {
            'action': 'order_custom',
            'name': name,
            'birthday': birthday,
            'phone': phone,
            'email': email,
            'address': address,
            'product': product,
            'price': price,
            'material': meterial,
            'color': color,
            'description': description,
        };

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {

            $.post(ajaxurl, data, function (e) {
                var obj = JSON.parse(e);
                if(obj.code == 1) {
                    modal.modal('show');
                    modal.on('hidden.bs.modal', function () {
                        window.location.href = url
                    });
                }
            });
        }
    });

    $('.button__search').click(function(e){
        e.preventDefault();
        $('body').addClass('form__search--js');
    });

    $('.close__search').click(function(e){
        e.preventDefault();
        $('body').removeClass('form__search--js');
    });


});

