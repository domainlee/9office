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
                        textSize.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">Tên size đã tồn tại</li></ul>')
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
                        groupCode.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">Mã màu đã tồn tại</li></ul>')
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
                        textSize.append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-custom-error-message">Tên size đã tồn tại</li></ul>')
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
                        _this.text('Đã gửi hàng');
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
                    alert('Thành công');
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
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
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
