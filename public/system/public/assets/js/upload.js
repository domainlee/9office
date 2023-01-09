var loadImage = {
    Load: function(o, p, callback, itemId, template, type){
        var ob = o ? o : '.list-image';
        var page = p ? p : null;
        var id = itemId ? itemId : null;
        var tem = template ? template: '/admin/media/media';
        var type_ = type ? type : null;
        $.post('/admin/media/index',{template: tem, terminal: true, page: page, itemId: id, type: type_},function(rs){
            if(page && id){
                $(ob).append(rs);
            }else {
                $(ob).empty().html(rs);
            }
            if(callback){
                callback($('.totalPage').attr('data-value'), rs);
            }
        });
    },
    Upload: function(){
        var modal = $('#full-width-modal');
        var navTab = modal.find('.nav-tabs li');
        var contentTab = modal.find('.tab-content .tab-pane');

        $("#imagemulti").change(function(){
            var ins = document.getElementById('imagemulti').files.length;
            var form_data = new FormData();
            for(x = 0; x < ins; x++){
                var file_data = $("#imagemulti").prop("files")[x];
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
                    if(url.code == 1){
                        loadImage.Load(null, null, returnData, null);

                        function returnData(r, d){
                            var list = $('.list-image');
                            var item = list.find('.image-item');
                            var btnInsert = $('.btn-insert');
                            var listInsert = $('.list-image-insert');
                            var listOne = $('.list-image-insert__one');

                            var idImage = $('#images');

                            item.on('click', function(){
                                item.removeClass('active');
                                $(this).addClass('active');
                            });

                            $('.modal-footer').unbind().on('click', '.btn-insert', function(e){
                                e.stopPropagation();
                                e.preventDefault();

                                var id = list.find('.image-item.active').attr('data-id');
                                var item = list.find('.image-item.active').clone();
                                if(listOne.length) {
                                    listInsert.empty().append(item);
                                } else {
                                    listInsert.append(item);
                                }
                                var items = [];
                                idImage.val(items.push(id));
                                item.removeClass('active');
                                var strItems = "";
                                listInsert.children().each(function (i) {
                                    var li = $(this);
                                    strItems += li.attr("data-id") + ',';
                                });
                                idImage.val(strItems);

                                listInsert.sortable({
                                    revert: false,
                                    stop: function( event, ui ) {
                                        var strItems = "";
                                        listInsert.children().each(function (i) {
                                            var li = $(this);
                                            strItems += li.attr("data-id") + ',';
                                        });
                                        idImage.val(strItems);
                                    }
                                });
                            });
                        }

                        navTab.removeClass('active').eq(0).addClass('active');
                        contentTab.removeClass('active').eq(0).addClass('active');
                    } else {
                        alert(url.message);
                    }
                }
            });
        });
    },
    Insert: function() {
        var list = $('.list-image');
        var item = list.find('.image-item');
        var btnInsert = $('.btn-insert');
        var listInsert = $('.list-image-insert');
        var idImage = $('#images');

        item.on('click', function(){
            item.removeClass('active');
            $(this).addClass('active');
        });

        $('#test').sortable();

        btnInsert.click(function(e){
            e.stopPropagation();
            e.preventDefault();

            var id = list.find('.image-item.active').attr('data-id');
            var item = list.find('.image-item.active').clone();
            listInsert.append(item);
            var items = [];
            idImage.val(items.push(id));
            item.removeClass('active');
            var strItems = "";
            listInsert.children().each(function (i) {
                var li = $(this);
                strItems += li.attr("data-id") + ',';
            });

            idImage.val(strItems);

            listInsert.sortable({
                revert: false,
                stop: function( event, ui ) {
                    var strItems = "";
                    listInsert.children().each(function (i) {
                        var li = $(this);
                        strItems += li.attr("data-id") + ',';
                    });
                    idImage.val(strItems);
                }
            });

        });
    }
}

$(function(){
    var productID = $('#productId');
    var categoryId = $('#categoryId');
    var brandId = $('#brandId');
    var articleId = $('#articleId');
    var bannerId = $('#bannerId');
    var pageId = $('#pageId');
    var articleCategoryId = $('#articleCategoryId');

    loadImage.Load(null, null, returnData, null);
    loadImage.Upload();

    if(productID.length){
        loadImage.Load('.list-image-insert', null, returnData, productID.val(), '/admin/media/media_list', 2);
    }
    if(categoryId.length){
        loadImage.Load('.list-image-insert', null, returnData, categoryId.val(), '/admin/media/media_list', 3);
    }
    if(brandId.length){
        loadImage.Load('.list-image-insert', null, returnData, brandId.val(), '/admin/media/media_list', 5);
    }
    if(articleId.length){
        loadImage.Load('.list-image-insert', null, returnData, articleId.val(), '/admin/media/media_list', 1);
    }
    if(bannerId.length){
        loadImage.Load('.list-image-insert', null, returnData, bannerId.val(), '/admin/media/media_list', 4);
    }
    if(pageId.length){
        loadImage.Load('.list-image-insert', null, returnData, pageId.val(), '/admin/media/media_list', 6);
    }
    if(articleCategoryId.length){
        loadImage.Load('.list-image-insert', null, returnData, articleCategoryId.val(), '/admin/media/media_list', 7);
    }

    var nextButton = $('.btn-next-image');
    var prevButton = $('.btn-prev-image');
    var dataPage = nextButton.attr('data-page');

    function returnData(r, d){

        var totalPage = r ? r : 0;
        if(totalPage > 1) {
            nextButton.unbind().on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var page = $('#pageImage'), m = parseInt(totalPage), v = parseInt(page.attr('data-value'));
                if( v < m ) {
                    loadImage.Load(null, v + 1, returnData, null);
                    page.attr('data-value', v + 1);
                }
            });
            prevButton.unbind().on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var page = $('#pageImage'), m = parseInt(totalPage), v = parseInt(page.attr('data-value'));
                if( v > 1 ) {
                    loadImage.Load(null, v - 1, returnData, null);
                    page.attr('data-value', v - 1);
                }
            });
        } else {
            nextButton.hide();
            prevButton.hide();
        }

        sortable();
        update_item();

        var list = $('.list-image');
        var item = list.find('.image-item');
        var btnInsert = $('.btn-insert');
        var listInsert = $('.list-image-insert');
        var listOne = $('.list-image-insert__one');
        var idImage = $('#images');

        item.on('click', function(){
            item.removeClass('active');
            $(this).addClass('active');
        });

        $('.modal-footer').unbind().on('click', '.btn-insert', function(e){
            e.stopPropagation();
            e.preventDefault();

            var id = list.find('.image-item.active').attr('data-id');
            var item = list.find('.image-item.active').clone();
            if(listOne.length) {
                listInsert.empty().append(item);
            } else {
                listInsert.append(item);
            }
            var items = [];
            idImage.val(items.push(id));
            item.removeClass('active');
            var strItems = "";
            listInsert.children().each(function (i) {
                var li = $(this);
                strItems += li.attr("data-id") + ',';
            });
            idImage.val(strItems);
            sortable();
            update_item();
        });

        function sortable() {
            var listInsert = $('.list-image-insert');
            var idImage = $('#images');

            listInsert.sortable({
                revert: false,
                stop: function( event, ui ) {
                    var strItems = "";
                    listInsert.children().each(function (i) {
                        var li = $(this);
                        strItems += li.attr("data-id") + ',';
                    });
                    idImage.val(strItems);
                }
            });
        }


    }

    function update_item () {
        var idImage = $('#images');
        var listInsert = $('.list-image-insert');
        var item = listInsert.find('.image-item');

        item.each(function(){
            $(this).click(function(e) {
                $(this).remove();
                var strItems = "";
                listInsert.children().each(function (i) {
                    var li = $(this);
                    strItems += li.attr("data-id") + ',';
                });
                idImage.val(strItems);
                e.stopPropagation();
                e.preventDefault();
            });
        });
    }

});