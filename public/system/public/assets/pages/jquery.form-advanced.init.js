/**
 * Theme: Ubold Admin Template
 * Author: Coderthemes
 * Form Advanced
 */


jQuery(document).ready(function () {

    //advance multiselect start
    if($('#my_multi_select3').length) {
        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    }

    function maxAllowedMultiselect(obj, maxAllowedCount) {
        var selectedOptions = jQuery('#'+obj.id+" option[value!=\'\']:selected");
        if (selectedOptions.length >= maxAllowedCount) {
            if (selectedOptions.length > maxAllowedCount) {
                selectedOptions.each(function(i) {
                    if (i >= maxAllowedCount) {
                        jQuery(this).prop("selected",false);
                    }
                });
            }
            jQuery('#'+obj.id+' option[value!=\'\']').not(':selected').prop("disabled",true);
        } else {
            jQuery('#'+obj.id+' option[value!=\'\']').prop("disabled",false);
        }
    }

    var select2 = $(".select2");
    if(select2.length) {
        select2.select2();
    }

    var selectProduct1 = $(".select-ajax-product");
    selectProduct1.each(function () {
        var selectProduct = $(this);
        var length = selectProduct.attr('data-length') ? selectProduct.attr('data-length'):5;
        var placeholderProduct = selectProduct.attr('data-placeholder') ? selectProduct.attr('data-placeholder'):'Sản phẩm liên quan';
        if(selectProduct.length) {
            selectProduct.select2({
                placeholder: placeholderProduct,
                multiple: true,
                maximumSelectionLength: length,
                ajax: {
                    url: "/admin/product/related",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term, // search term
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
            selectProduct.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });


    var selectArticle1 = $(".select-ajax-article");
    selectArticle1.each(function () {
        var selectArticle = $(this);
        var lengthArticle = selectArticle.attr('data-length') ? selectArticle.attr('data-length'):5;
        var placeholderArticle = selectArticle.attr('data-placeholder') ? selectArticle.attr('data-placeholder'):'Bài viết liên quan';
        if(selectArticle.length) {
            selectArticle.select2({
                placeholder: placeholderArticle,
                multiple: true,
                maximumSelectionLength: lengthArticle,
                ajax: {
                    url: "/admin/product/related",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term,
                            article: true
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
            selectArticle.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });


    var selectPage1 = $(".select-ajax-page");
    selectPage1.each(function () {
        var selectPage = $(this);
        var lengthPage = selectPage.attr('data-length') ? selectPage.attr('data-length'):5;
        var placeholderPage = selectPage.attr('data-placeholder') ? selectPage.attr('data-placeholder'):'Trang';
        if(selectPage.length) {
            selectPage.select2({
                placeholder: placeholderPage,
                multiple: true,
                maximumSelectionLength: lengthPage,
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
            selectPage.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });

    var selectBanner1 = $(".select-ajax-banner");
    selectBanner1.each(function () {
        var selectBanner = $(this);
        var lengthBanner = selectBanner.attr('data-length') ? selectBanner.attr('data-length'):5;
        var placeholderBanner = selectBanner.attr('data-placeholder') ? selectBanner.attr('data-placeholder'):'Banner';
        if(selectBanner.length) {
            selectBanner.select2({
                placeholder: placeholderBanner,
                multiple: true,
                maximumSelectionLength: lengthBanner,
                ajax: {
                    url: "/admin/product/related",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term,
                            banner: true
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

            selectBanner.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });

    var selectProductCategory1 = $(".select-ajax-productcategory");
    selectProductCategory1.each(function () {
        var selectProductCategory = $(this);
        var lengthProductCategory = selectProductCategory.attr('data-length') ? selectProductCategory.attr('data-length'):5;
        var placeholderProductCategory = selectProductCategory.attr('data-placeholder') ? selectProductCategory.attr('data-placeholder'):'Danh mục sản phẩm';
        if(selectProductCategory.length) {
            selectProductCategory.select2({
                placeholder: placeholderProductCategory,
                multiple: true,
                maximumSelectionLength: lengthProductCategory,
                ajax: {
                    url: "/admin/product/related",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term,
                            categoryproduct: true
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
            selectProductCategory.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });

    var selectArticleCategory1 = $(".select-ajax-articlecategory");
    selectArticleCategory1.each(function () {
        var selectArticleCategory = $(this);
        var lengthArticleCategory = selectArticleCategory.attr('data-length') ? selectArticleCategory.attr('data-length'):5;
        var placeholderArticleCategory = selectArticleCategory.attr('data-placeholder') ? selectArticleCategory.attr('data-placeholder'):'Danh mục bài viết';
        if(selectArticleCategory.length) {
            selectArticleCategory.select2({
                placeholder: placeholderArticleCategory,
                multiple: true,
                maximumSelectionLength: lengthArticleCategory,
                ajax: {
                    url: "/admin/product/related",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            keyword: params.term,
                            categoryarticle: true
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
            selectArticleCategory.on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        }
    });

    var selectTemplate = $(".select-ajax-template");
    var lengthTemplate = selectTemplate.attr('data-length') ? selectTemplate.attr('data-length'):5;
    var placeholderTemplate = selectTemplate.attr('data-placeholder') ? selectTemplate.attr('data-placeholder'):'Giao diện';
    if(selectTemplate.length) {
        selectTemplate.select2({
            placeholder: placeholderTemplate,
            multiple: false,
            maximumSelectionLength: lengthTemplate,
            ajax: {
                url: "/admin/product/related",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyword: params.term,
                        template: true
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
    }

    var selectStore = $(".select-ajax-store");
    var lengthStore = selectStore.attr('data-length') ? selectStore.attr('data-length'):5;
    var placeholderStore = selectStore.attr('data-placeholder') ? selectStore.attr('data-placeholder'):'Store';
    if(selectStore.length) {
        selectStore.select2({
            placeholder: placeholderStore,
            multiple: false,
            maximumSelectionLength: lengthStore,
            ajax: {
                url: "/admin/product/related",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        keyword: params.term,
                        store: true
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
    }

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



    if($(".select2-limiting").length) {
        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    }

    if($('.colorpicker-default').length) {
        $('.colorpicker-default').colorpicker({
            format: 'hex'
        });
    }

//    $('.selectpicker').selectpicker();
//    $(":file").filestyle({input: false});
});

//Bootstrap-TouchSpin
//$(".vertical-spin").TouchSpin({
//    verticalbuttons: true,
//    verticalupclass: 'ion-plus-round',
//    verticaldownclass: 'ion-minus-round'
//});

//$("input[name='demo1']").TouchSpin({
//    min: 0,
//    max: 100,
//    step: 0.1,
//    decimals: 2,
//    boostat: 5,
//    maxboostedstep: 10,
//    postfix: '%'
//});
//$("input[name='demo2']").TouchSpin({
//    min: -1000000000,
//    max: 1000000000,
//    stepinterval: 50,
//    maxboostedstep: 10000000,
//    prefix: '$'
//});
//$("input[name='demo3']").TouchSpin();
//$("input[name='demo3_21']").TouchSpin({
//    initval: 40
//});
//$("input[name='demo3_22']").TouchSpin({
//    initval: 40
//});
//
//$("input[name='demo5']").TouchSpin({
//    prefix: "pre",
//    postfix: "post"
//});
//$("input[name='demo0']").TouchSpin({});


//Bootstrap-MaxLength
//$('input#defaultconfig').maxlength()
//
//$('input#thresholdconfig').maxlength({
//    threshold: 20
//});
//
//$('input#moreoptions').maxlength({
//    alwaysShow: true,
//    warningClass: "label label-success",
//    limitReachedClass: "label label-danger"
//});
//
//$('input#alloptions').maxlength({
//    alwaysShow: true,
//    warningClass: "label label-success",
//    limitReachedClass: "label label-danger",
//    separator: ' out of ',
//    preText: 'You typed ',
//    postText: ' chars available.',
//    validate: true
//});
//
//$('textarea#textarea').maxlength({
//    alwaysShow: true
//});
//
//$('input#placement').maxlength({
//    alwaysShow: true,
//    placement: 'top-left'
//});