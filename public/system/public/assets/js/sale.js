$(function () {

    $('#form-add-client').submit(function(e) {
        var clientId = $('.clientId');
        var search = $('form#search input[name="q"]');
        var modalClient = $('#modal-client');

        var _name = $(this).find('.client-name');
        var _phone = $(this).find('.client-phone');
        var _address = $(this).find('.client-address');
        var _email = $(this).find('.client-email');
        var _birthday = $(this).find('.client-birthday');

        var clientName = $('.client__name');
        var clientPhone = $('.client__phone');

        var data = {};
        data['name'] = _name.val();
        data['phone'] = _phone.val();
        data['address'] = _address.val();
        data['email'] = _email.val();
        data['birthday'] = _birthday.val();
        data['gender'] = $('input[name=radioInline]:checked', $(this)).val();

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post('/admin/user/client', {'insert': data}, function (e) {
                if(e.status == 0) {
                    _phone.addClass('parsley-error');
                    alert(e.messenger);
                } else if(e.status == 1) {
                    _name.val('');
                    _phone.val('');
                    _address.val('');
                    _email.val('');
                    _birthday.val('');
                    clientId.val(e.clientId);
                    clientName.text(e.clientName);
                    clientPhone.text(e.clientPhone);
                    search.val(e.clientFullName);
                    modalClient.modal('hide');
                }
            });
        }
    });

    window.addEventListener("keydown", function (event) {
        switch (event.key) {
            case "ArrowLeft":
                var _page = $('.currentPage');
                var _v = parseInt(_page.attr('data-value'));
                var _key = $('form.sale__form-product input').val();
                if( _v > 1 ) {
                    pagination(_v-1, _key);
                    _page.attr('data-value', _v - 1);
                }
                break;
            case "ArrowRight":
                var _totalPage = $('.totalPage').attr('data-value');
                var _page = $('.currentPage');
                var _m = parseInt(_totalPage);
                var _key = $('form.sale__form-product input').val();
                var _v = parseInt(_page.attr('data-value'));
                if( _v < _m ) {
                    pagination(_v+1, _key);
                    _page.attr('data-value', _v + 1);
                }
                break;
            case "F9":
                print();
                break;
            default:
                return;
        }
        event.preventDefault();
    }, true);

    var nextButton = $('.sale__button-next');
    var prevButton = $('.sale__button-prev');
    var modal = $('#modal-general');
    var modalContent = $('#modal-general').find('.modal-general__content');


    nextButton.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var totalPage = $('.totalPage').attr('data-value');
        var _key = $('form.sale__form-product input').val();
        var page = $('.currentPage'), m = parseInt(totalPage), v = parseInt(page.attr('data-value'));
        if( v < m ) {
            pagination(v+1, _key);
            page.attr('data-value', v + 1);
        }
    });

    prevButton.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var page = $('.currentPage'), v = parseInt(page.attr('data-value'));
        var _key = $('form.sale__form-product input').val();
        if( v > 1 ) {
            pagination(v-1, _key);
            page.attr('data-value', v - 1);
        }
    });

    function pagination(p, k) {
        var p = p;
        var k = k;
        $.post('/admin/product/sale',{'key' : k, 'page': p, 'template': '/admin/product/productorder', 'terminal': true}, function(rs) {
            $('.sale__inner').empty().html(rs);
            $.getScript(script());
        });
    }
    
    function script() {
        $('.lazy').Lazy({
            effect: "fadeIn",
            effectTime: 500,
        });
        addCart();
    }

    function load_browser() {
        var cartProduct = $.shoppingcart('getAll');
        var html = $('.sale__list-order');
        var htmlRight = $('.sale__right--button');
        var htmlPrint = $('.client__list');
        if(cartProduct) {
            var item = '';
            var itemClient = '';
            var totalMoney = 0;
            $.each(cartProduct, function (index, value) {
                var option = '';
                for(i = 1; i <= value.totalQuantity ;i++) {
                    option += '<option value="'+i+'" '+ ( i == value.count ? 'selected':null ) +'>'+i+'</option>';
                }
                totalMoney += (value.price - value.priceOff) * value.count;
                item += '<tr>' +
                            '<td><img src="'+value.image+'" class="img-circle thumb-sm" /></td>'+
                            '<td>'+value.name+'</td>'+
                            '<td><b>'
                            +number_format(value.price)+' đ'+
                            '<br/><a href="#" class="fieldEditor" data-id="'+value.id+'" data-emptytext="Giảm tiền" data-type="text" data-price="'+value.price+'" data-pk="1" data-placement="right" data-placeholder="Số tiền" data-title="Giảm giá" data-value="'+value.priceOff+'">'+number_format(value.priceOff)+' đ</a>'+
                            '</b></td>'+
                            '<td>'+
                            '<select data-id="'+value.id+'" class="form-control changeQuantity">'+option+'</select>'+
                            '</td>'+
                            '<td><b>'+number_format((value.price - value.priceOff) * value.count)+' đ</b></td>'+
                            '<td style="text-align: center"><a data-id="'+value.id+'" class="sale__button-remove table-action-btn"><i class="md md-close"></i></a></td>'+
                        '</tr>';
                itemClient += '<div class="client__item-product">'+
                            '<div>'+value.name+'</div>'+
                            '<div>'+
                            number_format(value.price)+
                            (value.priceOff ? '<span> - '+number_format(value.priceOff)+'</span>':'')+' x '+value.count+
                            '</div>'+
                            '<div><b>'+number_format((value.price - value.priceOff) * value.count)+' đ</b></div>'+
                            '</div>';
            });
            html.html(item);
            var itemRight = '<div class="form-group">'+
                            '<div class="row">'+
                            '<div class="col-md-12">'+
                            '<hr>'+
                            '<h3 class="text-center">Tổng: '+number_format(totalMoney)+' VNĐ</h3>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '<a class="sale__button-print  btn btn-block btn-lg btn-default waves-effect waves-light">Thanh toán</a>';
            if(cartProduct.length > 0) {
                htmlRight.html(itemRight);
            } else {
                htmlRight.html('');
            }
            var htmlPrintTotal = '<div class="client__toltalmoney">'+
                                '<h4 class="text-right">Tổng: '+number_format(totalMoney ? totalMoney:0)+' đ</h4>'+
                                '</div>';
            htmlPrint.html(itemClient + htmlPrintTotal);
        }
        $.getScript(removeCart(),Editable(),changeQuantity(),printOrder());
    }
    load_browser();

    addCart();
    function addCart() {
        var product = $('.sale__inner');
        var item = product.find('.sale__item--inner');
        var _list = $('.sale__list-order');
        var _right = $('.sale__right');
        var _listPrint = $('.client__list');

        item.click(function (e) {
            var id = $(this).attr('data-id'),
                title = $(this).attr('data-title'),
                image = $(this).attr('data-image'),
                price = $(this).attr('data-price'),
                quantity = $(this).attr('data-quantity');
                totalQuantity = $(this).attr('data-quantity-total');

            $.shoppingcart('add', {
                'id': id,
                'image': image,
                'name': title,
                'code': '000',
                'url': 'http://dweb.vn',
                'attributes': [],
                'price': price,
                'priceOff': 0,
                'count': quantity,
                'totalQuantity': totalQuantity
            });
            $.getScript(load_browser());
        });
    }

    function toNumber (value) {
        value = value * 1;
        return isNaN(value) ? 0 : value;
    }

    removeCart();

    function removeCart() {
        var _list = $('.sale__list-order');
        var _right = $('.sale__right');
        var _listPrint = $('.client__list');

        var _buttonRemove = _list.find('.sale__button-remove');
        _buttonRemove.click(function () {
            var _dataId = $(this).attr('data-id');
            $.shoppingcart('remove',{'id': _dataId});
            load_browser();
        });
    }

    changeQuantity();
    function changeQuantity() {
        $('.changeQuantity').change(function(){
            var id = $(this).attr('data-id');
            var quantity = $(this).find(':selected').text();
            $.shoppingcart('edit', {
                'id': id,
                'count': quantity,
            });
            $.getScript(load_browser());
        });
    }

    var _buttonClose = $('.sale__button-close');
    _buttonClose.click(function () {
        var i = $(this).find('i');
        $('body').toggleClass('product-open');
        var bodyOpen = $('body').hasClass("product-open");
        if(bodyOpen){
        }else{
        }
    });

    var _list = $('.sale__inner');
    var _searchInput = $('form.sale__form-product input');

    _searchInput.autocomplete({
        source: function () {
            $.post('/admin/product/sale',
                {
                    key: _searchInput.val(),
                    template: '/admin/product/productorder',
                    terminal: 1
                }, function (data) {
                    _list.empty().html(data);
                    $.getScript(script());
                }
            );
        },
    });

    _searchInput.keyup(function () {
        if (!$(this).val().length) {
            $.post('/admin/product/sale',
                {
                    key: _searchInput.val(),
                    template: '/admin/product/productorder',
                    terminal: 1
                }, function (data) {
                    _list.empty().html(data);
                    $.getScript(script());
                }
            );
            _searchInput.blur();
        }
    });
    
    function selectClient() {
        var selectClient = $(".select-ajax-client");
        selectClient.each(function () {
            var selectClient = $(this);
            var lengthClient = selectClient.attr('data-length') ? selectClient.attr('data-length'):5;
            var placeholderClient = selectClient.attr('data-placeholder') ? selectClient.attr('data-placeholder'):'Khách hàng';
            if(selectClient.length) {
                selectClient.select2({
                    placeholder: placeholderClient,
                    multiple: true,
                    maximumSelectionLength: lengthClient,
                    ajax: {
                        url: "/admin/product/related",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                keyword: params.term,
                                page: true
                            };
                        },
                        processResults: function (data, params) {
                            return {
                                results: data,
                            };
                        },
                        cache: true
                    },
                });
                selectClient.on("select2:select", function (evt) {
                    var element = evt.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");
                });
            }
        });
    }

    Editable();

    function Editable () {
        var editor = $('.fieldEditor');
        var _list = $('.sale__list-order');
        var _right = $('.sale__right');
        var _listPrint = $('.client__list');

        editor.editable({
            type: 'text',
            display: function(value, response) {
                $(this).attr("data-value", value);
            },
            validate: function(value) {
                var regex = /^[0-9]+$/;
                var price = $(this).attr('data-price');
                if(! regex.test(value)) {
                    return 'Chỉ hỗ trợ dạng số';
                }
            },
            success: function(response, newValue) {
                $.shoppingcart('edit', {
                    'id': $(this).attr('data-id'),
                    'priceOff': newValue,
                });
                $.getScript(load_browser());
            }
        });
    }

    function actionClient() {
        var search = $('form#search input[name="q"]');
        var clientId = $('.clientId');
        var clientName = $('.client__name');
        var clientPhone = $('.client__phone');
        var _li = $('#searchFolding').find('li');
        _li.each(function () {
            _li.find('a').click(function () {
                clientId.val($(this).attr('data-id'));
                search.val($(this).text());
                clientName.text($(this).attr('data-name'));
                clientPhone.text($(this).attr('data-phone'));
            });
        });
    }

    clientSearch();

    function clientSearch() {
        var clientId = $('.clientId');
        var fsearch = $('form#search'), search = $('form#search input[name="q"]');
        search.autocomplete({
            source: function () {
                var s = $('#searchFolding');
                s.slideDown();
                $.post('/admin/user/client',
                    {name: search.val(), template: '/admin/user/client_list', terminal: 1},
                    function (data) {
                        s.html(data);
                        $.getScript(actionClient());
                    }
                );
            }
        });
        search.keyup(function () {
            if (!$(this).val().length) {
                $('#searchFolding').slideUp();
                clientId.val('');
            }
        }).focus(function () {
            if ($(this).val().length) {
                $('#searchFolding').slideDown();
            }
        }).focusout(function () {
            $('#searchFolding').slideUp();
        });
    }

    function printOrder() {
        $('.sale__button-print').click(function (e) {
            e.preventDefault();
            print();
        });
    }

    function print() {
        var _clientId = $('.clientId');
        var _payment = $('input[name=paymentMethod]:checked').val();
        var _list = $('.sale__list-order');
        var _right = $('.sale__right');
        var _listPrint = $('.client__list');
        var cartProduct = JSON.stringify($.shoppingcart('getAll'));
        var popup = false;

        // console.log('print');

        // setTimeout(function() {
            $.post('/admin/product/createorder',{ clientId: _clientId.val(), payment: _payment, product: cartProduct}, function(r) {
                if(r.code == 1) {
                    popup = true;
                }
            }).done(function(){
                // var printContents = document.getElementById('printableArea').innerHTML;
                // w=window.open();
                // w.document.write(printContents);
                // w.print();
                // w.close();
            });
        // }, 500);

        setTimeout(function () {
            var printContents = document.getElementById('printableArea').innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }, 500);

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

});