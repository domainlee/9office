/**
 * Created by mienle on 5/4/17.
 */
$(function(){
    function _change(ob, path) {
        var btnChangeStatus = $(ob);
        var buttonURL = btnChangeStatus.closest('a');

        buttonURL.click(function (e) {
            e.preventDefault();
        });

        btnChangeStatus.change(function (e) {
            var t = $(this);
            var Id = t.attr('data-id');
            $.post(path, {'id': Id}, function(r){
                if(r.code == 0) {
                    alert(r.messenger);
                }
            });
            e.preventDefault();
        });
    }

    _change('.changeStatus', '/admin/product/change');
    _change('.changecStatus', '/admin/product/changec');
    _change('.changeBrandStatus', '/admin/product/changeBrand');
    _change('.changeArticleStatus', '/admin/article/change');
    _change('.changeArticlecStatus', '/admin/article/changec');
    _change('.changePageStatus', '/admin/page/change');
    _change('.changeBannerStatus', '/admin/media/change');
    _change('.changeUserStatus', '/admin/user/change');
    _change('.changeCommentStatus', '/admin/setup/changecomment');


    function _delete(ob, h, url) {
        var hide = true;
        var t = $(ob);
        var clicks = true;
        t.click(function(e) {
            var _this = $(this);
            var productId = _this.attr('data-id');
            var tr = _this.closest('tr');
            e.preventDefault();
            if (clicks) {
                $(this).text('OK');
                $(this).removeClass('fa fa-trash-o');
                clicks = false;
            } else {
                $.post(url, {'id': productId}, function(r){
                    if(r.code == 1) {
                        tr.slideUp(1000, function () {
                            $(this).remove();
                        });
                    } else if(r.code == 0) {
                        alert(r.messenger);
                    }
                });
                clicks = true;
            }
        });

        $('html').click(function(e){
            if ($(e.target).hasClass(h)) {
                return false;
            }
            if(hide){
                t.addClass('fa fa-trash-o').text('');
            }
            clicks = true;
            hide = true;
        });
    }

    _delete('.deleteProduct', 'deleteProduct', '/admin/product/delete');
    _delete('.deleteCategory', 'deleteCategory', '/admin/product/deletecategory');
    _delete('.deleteBrand', 'deleteBrand', '/admin/product/deletebrand');
    _delete('.deleteAttr', 'deleteAttr', '/admin/product/deleteattr');
    _delete('.deleteOrder', 'deleteOrder', '/admin/product/deleteorder');
    _delete('.deleteArticle', 'deleteArticle', '/admin/article/delete');
    _delete('.deleteArticlec', 'deleteArticlec', '/admin/article/deletec');
    _delete('.deletePage', 'deletePage', '/admin/page/delete');
    _delete('.deleteBanner', 'deleteBanner', '/admin/media/delete');
    _delete('.deleteUser', 'deleteUser', '/admin/user/delete');
    _delete('.deleteDomain', 'deleteDomain', '/admin/store/delete');
    _delete('.deleteWebsite', 'deleteWebsite', '/admin/user/deletedomain');
    _delete('.deleteComment', 'deleteComment', '/admin/setup/deleteccomment');


    $btnChangeType = $('.changeType');

    if($btnChangeType.length) {
        $btnChangeType.on('change', function(){
            var _this = $(this);
            var productId = _this.attr('data-id');
            var selected = [];
            _this.find("option:selected").each(function(key,value){
                selected.push(value.getAttribute('data-value'));
            });

            $.post('/admin/product/type', {'id': productId, 'type': selected}, function(r){

            });
        });
    }

    if($('#addSize').length) {
        $("#addSize").on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var size = form.find('#size');
            var textSize = form.find('.text-size');
            form.parsley().validate();

            if (form.parsley().isValid()){
                $.post('/admin/product/attr', {'size': size.val()}, function(r){
                    if(r.status == 0) {
                        size.addClass('parsley-error');
                        textSize.find('.parsley-errors-list').remove();
                        textSize.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">T??n size ???? t???n t???i</li></ul>')
                    } else if (r.status == 1){
                        location.reload();
                    }
                });
            }
        });
    }

    if($('#addColor').length) {
        $("#addColor").on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var nameColor = form.find('#nameColor');
            var colorCode = form.find('#nameCode');
            var groupCode = form.find('.group-code');
            form.parsley().validate();
            if (form.parsley().isValid()) {
                $.post('/admin/product/attr', {'color': nameColor.val(),'code': colorCode.val() }, function(r){
                    if(r.status == 0) {
                        groupCode.find('.parsley-errors-list').remove();
                        groupCode.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">M?? m??u ???? t???n t???i</li></ul>')
                    } else if (r.status == 1) {
                        location.reload();
                    }
                });
            }
        });
    }

    if($('#addMaterial').length) {
        $("#addMaterial").on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var size = form.find('#nameMaterial');
            var textSize = form.find('.group-material');
            form.parsley().validate();

            if (form.parsley().isValid()){
                $.post('/admin/product/attr', {'material': size.val()}, function(r){
                    if(r.status == 0) {
                        size.addClass('parsley-error');
                        textSize.find('.parsley-errors-list').remove();
                        textSize.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">T??n size ???? t???n t???i</li></ul>')
                    } else if (r.status == 1){
                        location.reload();
                    }
                });
            }
        });
    }

    if($('.orderSuccess').length) {
        $('.orderSuccess').click(function (e) {
            e.preventDefault();
            var _this = $(this);
            $.post('/admin/product/changeorder', {'id': _this.attr('data-id')}, function(r){
                if(r.status == 0) {
                    alert(r.messenger);
                } else if (r.status == 1){
                    _this.text('Loading ...');
                    setTimeout(function(){
                        _this.text('???? g???i h??ng');
                        location.reload();
                    }, 1000);
                }
            });
        });
    }

    var urlBanner = $('.urlBanner');
    var selectBannerProduct = $('.select-ajax-product');
    var selectBannerArticle = $('.select-ajax-article');

    if(urlBanner.length) {
        urlBanner.on('input', function (e) {
            // e.preventDefault();
            console.log($(this).val());
            selectBannerProduct.select2('val', '')
            selectBannerArticle.select2('val', '')
        });
    }
});

$(function(){
    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $('.button-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled:true
        }
    });

    // Material
    if($('.material-form').length) {
        var input_price = $('input[name=price]');
        var manufactureId = $('select[name=manufactureId]');
        $('select.material-type').on('change', function() {
            if(this.value == 3) {
                $('select[name=manufactureId] option:selected').removeAttr('selected');
                input_price.prop('disabled', false);
            } else {
                input_price.prop('disabled', true);
            }
        });
    }

    if($('.invoice-form').length) {
        var input_price_invoice = $('input[name=price]');
        var quantity = $('input[name=quantity]');
        var intoMoney = $('input[name=intoMoney]');

        quantity.keyup(calculate);
        input_price_invoice.keyup(calculate);

        function calculate(e) {
            var value_price = input_price_invoice.val();
            value_price = value_price.replace(",", "");
            var value_quantity = quantity.val();
            value_quantity = value_quantity.replace(",", "");

            intoMoney.val(value_price * value_quantity);
            intoMoney.autoNumeric().trigger('focusout');
        }
    }

    $('.btn-approved-invoice').click(function () {
        console.log('click approved');
        var id = $(this).attr('data-id'), _this = $(this);
        $.post('/admin/invoice/import',{id: id},function(r){
            if(r.code == 1){
                alert(r.messenger);
                location.reload();
            }else if(r.code == 0){
                alert(r.messenger);
            }
        });
    });

    $('.btn-in-production').on('click', function () {
        var data = $(this).attr('data-production'), _this = $(this);

        if (confirm('B???n s??? s???n xu???t ????n h??ng n??y ?')) {
            $.post('/admin/material/ordermanufacture',{data: data},function(r){
                // if(r.code == 1){
                //     alert(r.messenger);
                //     location.reload();
                // }else if(r.code == 0){
                //     alert(r.messenger);
                // }
            });
        }
    });

    var list_product_material = $('.list-product-material');
    $('.add-product-item').click(function () {
        $.post('/admin/material/additemproduct',{type: 'add'},function(r){
            list_product_material.html('').html(r);
        });
    });

    $('.edit-product-item').click(function () {
        var productId = $(this).attr('data-product-id');
        $.post('/admin/material/additemproduct',{type: 'edit', product_id: productId},function(r){
            list_product_material.html('').html(r);
        });
    });

    $('.remove-product-item').click(function () {
        var product_id = $(this).attr('data-product');
        var material_id = $(this).attr('data-material');
        $.post('/admin/material/additemproduct',{type: 'remove', product_item_id: product_id, material_id: material_id},function(r){
            list_product_material.html('').html(r);
        });
    });

    var import_coin = {
        import_coin_inner: $('.import-coin'),
        _form: $('.form_import_coin'),
        _buttonImport: $('.import-coin__button-import'),
        _errors: $('.errors'),
        _success: $('.success'),
        init: function () {
            // $(window).on( 'load', this.validate );
            this._buttonImport.on('click', this.import );
        },
        validate: function () {
            // import_coin._form.validate({
            //     rules: {
            //         file_import: {
            //             required : true,
            //             accept: "application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            //         },
            //     },
            //     messages: {
            //         file_import: "Please select the file, or choose the correct file type xls, xlxs"
            //     }
            // });
        },
        import: function () {
            // var formValid = import_coin._form.valid();
            // if(formValid) {
                var t = $('input.excel_file_material');
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();

                    if (reader.readAsBinaryString) {
                        reader.onload = function (e) {
                            import_coin.read_data(e.target.result);
                        };
                        reader.readAsBinaryString(t.prop('files')[0]);
                    } else {
                        reader.onload = function (e) {
                            var data = "";
                            var bytes = new Uint8Array(e.target.result);
                            for (var i = 0; i < bytes.byteLength; i++) {
                                data += String.fromCharCode(bytes[i]);
                            }
                            import_coin.read_data(data);
                        };
                        reader.readAsArrayBuffer(t.prop('files')[0]);
                    }
                } else {
                    alert("This browser does not support HTML5.");
                }
            // }
        },
        read_data: function (data) {
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            var formData = new FormData();
            formData.append("type", 'import');
            workbook.SheetNames.forEach(function (k, v) {
                var sheet = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[k], {defval:''});
                formData.append(k.replace(/[^A-Z0-9]+/ig, '_').toLowerCase(), JSON.stringify(sheet));
            });
            $.ajax({
                type: "POST",
                url: '/admin/material/importmaterial',
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
            }).done(function (e) {
                import_coin._errors.text('').text(e.errors + ' V???t li???u ???? t???n t???i, ho???c d??? li???u ch??a ph?? h???p');
                import_coin._success.text('').text(e.success + ' T???o m???i');
                // location.reload();
            });
        }

    }

    import_coin.init();

    jQuery('#date-range').datepicker({
        toggleActive: true,
    });

    var tmp = [];
    var table = $('.product_list');
    var button_selected = $('.button-export-selected');
    button_selected.prop('disabled', false);
    var coin_remove = $('.coin_remove');
    var coin_change = $('.coin_change');
    coin_change.prop('disabled', true);

    table.on("click", "input[type=checkbox]", function(e){
        var $this = $(this);
        var checked = $this.val();
        if ($this.is(':checked')) {
            tmp.push(checked);
        } else {
            tmp.splice($.inArray(checked, tmp),1);
        }
        button_selected.attr('href','/admin/material/exportproduct?ids=' + encodeURIComponent(tmp));

        if(tmp.length > 0) {
            button_selected.prop('disabled', false);
        } else {
            button_selected.prop('disabled', true);
        }
        button_selected.attr('data-ids', tmp);
    });

    $('.button-export-all').click(function () {
        window.open('/admin/material/exportproduct', '_blank');
    });

    button_selected.click(function () {
        if(tmp.length > 0) {
            tmp = [];
            button_selected.attr('data-ids', tmp);
            table.find('input:checkbox').removeAttr('checked');
        } else {
            alert('Ch??a ch???n s???n ph???m export');
        }
    });


    if($('#imageUpload').length) {
        $("#imageUpload").change(function(){
            var ins = document.getElementById('imageUpload').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#imageUpload").prop("files")[x];
                form_data.append("imagemulti[]", file_data);
            }
            $.ajax({
                data: form_data,
                type: "POST",
                url: "/admin/media/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    if(url.code){
                        alert(url.message);
                    }
                }
            });
        });
    }

    if($('#fileName').length){
        var X = XLSX;
        var xlf = document.getElementById('fileName');
        function handleFile(e) {
            var files = e.target.files;
            var f = files[0];
            var reader = new FileReader();
            var name = f.name;
            reader.onload = function(e) {
                if (typeof console !== 'undefined')
                    console.log("onload", new Date());
                var data = e.target.result;
                var arr = fixdata(data);
                var wb = X.read(btoa(arr), {
                    type : 'base64'
                });
                var jsonStr = process_wb(wb);
                $('#data').val(jsonStr);
            };
            reader.readAsArrayBuffer(f);
        }
        if (xlf.addEventListener)
            xlf.addEventListener('change', handleFile, false);
        function fixdata(data) {
            var o = "", l = 0, w = 10240;
            for (; l < data.byteLength / w; ++l)
                o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l
                    * w + w)));
            o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
            return o;
        }
        function process_wb(wb) {
            var output = "";
            output = JSON.stringify(to_json(wb), 2, 2);
            return output;
        }
        function to_json(workbook) {
            var result = {};
            workbook.SheetNames
                .forEach(function(sheetName) {
                    var roa = X.utils
                        .sheet_to_row_object_array(workbook.Sheets[sheetName]);
                    if (roa.length > 0) {
                        result[sheetName] = roa;
                    }
                });
            return result;
        }

        $('#submitImport').click(function(){
            $.post('/admin/product/importexcel',{data: $('#data').val()},function(r){
                if(r.code == 0){
                    alert(r.error);
                } else if(r.code == 1) {
                    alert('Th??nh c??ng');
                }
            });
        });

    }

    if($('#popup_image').length) {
        $("#popup_image").change(function(){
            var _this = $(this);
            var imgLogo = _this.closest('.form-group__popup').find('.imgLogo');
            var val = _this.closest('.form-group__popup').find('.popup_image');
            var ins = document.getElementById('popup_image').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#popup_image").prop("files")[x];
                form_data.append("imagemulti[]", file_data);
            }
            $.ajax({
                data: form_data,
                type: "POST",
                url: "/admin/media/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    if(url.code) {
                        imgLogo.html('<img class="img-responsive img-thumbnail" src="'+url.url+'" />');
                        val.val(url.url);
                    }
                }
            });
        });
    }

    if($('#logo').length) {
        $("#logo").change(function(){
            var _this = $(this);
            var imgLogo = _this.closest('.form-group__logo').find('.imgLogo');
            var val = _this.closest('.form-group__logo').find('.logo');
            var ins = document.getElementById('logo').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#logo").prop("files")[x];
                form_data.append("imagemulti[]", file_data);
            }
            $.ajax({
                data: form_data,
                type: "POST",
                url: "/admin/media/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    if(url.code) {
                        imgLogo.html('<img class="img-responsive img-thumbnail" src="'+url.url+'" />');
                        val.val(url.url);
                    }
                }
            });
        });
    }

    if($('#favicon').length) {
        $("#favicon").change(function(){
            var _this = $(this);
            var imgLogo = _this.closest('.form-group__favicon').find('.imgFavicon');
            var value = _this.closest('.form-group__favicon').find('.favicon');
            var ins = document.getElementById('favicon').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#favicon").prop("files")[x];
                form_data.append("imagemulti[]", file_data);
            }
            $.ajax({
                data: form_data,
                type: "POST",
                url: "/admin/media/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    if(url.code){
                        imgLogo.html('<img class="img-responsive img-thumbnail" src="'+url.url+'" />');
                        value.val(url.url);
                    }
                }
            });
        });
    }

    if($('#menuImage').length) {
        $("#menuImage").change(function(){
            var _this = $(this);
            var imgLogo = _this.closest('.wrapper-image').find('.captionImage');
            var value = _this.closest('.wrapper-image').find('.menuImage');
            var ins = document.getElementById('menuImage').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#menuImage").prop("files")[x];
                form_data.append("imagemulti[]", file_data);
            }
            $.ajax({
                data: form_data,
                type: "POST",
                url: "/admin/media/upload",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    if(url.code) {
                        imgLogo.html('<img class="img-responsive img-thumbnail" src="'+url.url+'" />');
                        value.val(url.url);
                    }
                }
            });
        });
    }

    if($('.updateHomepage').length) {
        $.post('/admin/page/homepage', {update: true} , function(e){});
        $.post('/admin/setup/template', {update: true} , function(e){});
    }

    if($('.addField').length) {
        $('.addField').click(function (e) {
            var valField = $('.inputField').val();
            $.post('/admin/article/field', {field: valField} , function(r){
                if(r.code == 1) {
                    location.reload();
                } else {
                    alert(r.messenger);
                }
            });
        });
    }

    if($('.deleteField').length) {
        $('.deleteField').click(function (e) {
            var k = $(this).attr('data-key');
            $.post('/admin/article/deletefield', {field: k} , function(r){
                if(r.code == 1) {
                    location.reload();
                } else {
                    alert(r.messenger);
                }
            });
        });
    }

    if($('.addFieldProduct').length) {
        $('.addFieldProduct').click(function (e) {
            var valField = $('.inputFieldProduct').val();
            $.post('/admin/article/field', {field: valField, product: true} , function(r){
                if(r.code == 1) {
                    location.reload();
                } else {
                    alert(r.messenger);
                }
            });
        });
    }

    if($('.deleteFieldProduct').length) {
        $('.deleteFieldProduct').click(function (e) {
            var k = $(this).attr('data-key');
            $.post('/admin/article/deletefield', {field: k, product: true} , function(r){
                if(r.code == 1) {
                    location.reload();
                } else {
                    alert(r.messenger);
                }
            });
        });
    }

    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    $('.product-admin__bell').click(function (e) {
        e.preventDefault();
        var t = $(this);
        var image = t.attr('data-image');
        var url = t.attr('data-url');
        $('.bell-image').val(image);
        $('.bell-url').val(url);
    });

    function updateView(title, url, description) {
        var _title = title;
        var _url = url;
        var _description = description;
        var _html = $('.box-view__inner');
        var _oUrl = $('input[name=url]');
        $.post('/admin/product/url', { title: _title, url: _url,  description: _description }, function (r) {
            _html.html(r);
        });
        $.post('/admin/product/url', { title: _title, url: _url,  description: _description, json: true }, function (r) {
            _oUrl.val(r.url);
        });
    }

    var _title = $('input[name=metaTitle]');
    var _description = $('textarea[name=metaDescription]');
    var _url2 = $('input[name=url]');

    var viewTitle = $('.box-view__title');
    var viewURL = $('.box-view__url');
    var viewDescription = $('.box-view__desciption');
    var urlHome = $('.box-view__home').val();

    _title.keyup(function() {
        _title = $(this).val();
        viewTitle.html(_title);
        _url2.val(ChangeToSlug(_title));
        viewURL.html(urlHome + '/' + ChangeToSlug(_title) +'.html');
    });

    _description.keyup(function() {
        viewDescription.html($(this).val());
    });

    _url2.keyup(function() {
        viewURL.html(urlHome + '/' + ChangeToSlug($(this).val()) +'.html');
        viewURL.attr('href', urlHome + '/' + ChangeToSlug($(this).val()) +'.html');
    });

    function ChangeToSlug(a)
    {
        var title, slug;
        title = a;
        slug = title.toLowerCase();
        slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
        slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
        slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
        slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
        slug = slug.replace(/??|???|???|???|???/gi, 'y');
        slug = slug.replace(/??/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    }

    $('.btn__view-module').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var t = $(this);
        var module = t.attr('data-module');
        var layout_module = $('input[name='+module+']');
        if(layout_module.val() == 1) {
            layout_module.val(0);
            t.find('i').removeClass('ion-eye').addClass('ion-eye-disabled');
        } else {
            layout_module.val(1);
            t.find('i').removeClass('ion-eye-disabled').addClass('ion-eye');
        }
    });
    
    $("select[name='pageTemplate']").change(function() {
        $.post('/admin/page/edit', {template: $(this).val(), terminal: true, id: $(this).find(':selected').attr('data-id')}, function (r) {
            $('.card-box__custom').html(r);
        });
    });

    var modal = $('#global-admin-modal');

    $('.btn__setup').click(function(e){
        e.preventDefault();
        modal.show();
    });

    $(".formArticle").on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        form.parsley().validate();
        var data = form.serialize();
        if (form.parsley().isValid()){
            console.log();
            $.post('/admin/setup/page', data, function(r){
                if(r.code == 1) {
                    location.reload();
                }
            });
        }
    });


    $('.button-open-menu-left').click(function(){
        $.post('/admin/admin/optionadmin', {'menuleft': true}, function(r){

        });
    });


});
