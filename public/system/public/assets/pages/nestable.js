
/**
* Theme: Ubold Admin Template
* Author: Coderthemes
* Nestable Component
*/

!function($) {
    "use strict";

    var Nestable = function() {};

    Nestable.prototype.init = function() {

        var Menu = $('.menuDweb');
        Menu.each(function () {
            var data = $('.dataMenu');
            var dataMenu = '';
            var this_ = $(this);
            this_.nestable({
                group: 1,
                customActions   : {
                    "remove"    : function(item,button,e, ob) {
                        item.remove();
                        dataMenu = ob.nestable('serialize');
                        data.val(ob.nestable('serialize'));
                    }
                },
                eventCustom: function (obj) {
                    $('.btnCustomUrl').unbind().click(function (e) {
                       e.preventDefault();
                       var _this = $(this);
                       var urlMain = _this.closest('.urlMain');
                        urlMain.toggleClass("urlMainActive");
                        if(!urlMain.hasClass('urlMainActive')) {
                            $('.urlHand').val('');
                        }
                    });
                    $('.addMenu').on('click', function (e) {
                        e.preventDefault();
                        var form = $('.formAddMenu');
                        var textMenu = $('.inputMenu').val();
                        var id = $('.pathMenu :selected').attr('data-id');
                        var urlOption = $('.pathMenu :selected').attr('data-url');
                        var urlHand = $('.urlHand').val();
                        var url = urlHand ? urlHand : urlOption;
                        var panel = obj.closest('.tab-pane');
                        var image = $('.captionImage img').attr('src');

                        form.parsley().validate();
                        if (form.parsley().isValid()){
                            var html = '<li class="dd-item" data-id="'+id+'" data-image="'+image+'" data-url="'+url+'"  data-name="'+textMenu+'"><button class="dd-action pull-right" type="button" data-action="remove" title="Remove"><i class="ti-close"></i></button><div class="dd-handle">'+textMenu+'</div></li>';
                            if(panel.hasClass('active')) {
                                var ddList = obj.find('.outer');
                                ddList.append(html);
                                dataMenu = obj.nestable('serialize');
                                data.val(obj.nestable('serialize'));
                                $('.urlHand').val();
                            }
                        }

                    });
                }
            }).on('change', function (e) {
                e.preventDefault();
                var list = e.length ? e : $(e.target);
                dataMenu = list.nestable('serialize');
                data.val(list.nestable('serialize'));
            });

            var panel = this_.closest('.tab-pane');
            panel.find('.saveMenu').click(function (e) {
                var saveMenu = $(this);
                e.preventDefault();
                $.post('/admin/setup/menu', {
                    'data': dataMenu,
                    'dataKey': $(this).attr('data-key')
                }, function (e) {
                    saveMenu.text('Đang lưu ...');
                    setTimeout(function(){
                        saveMenu.text('Lưu');
                        location.reload();
                    }, 1500);
                });
            });

        });



    },
    //init
    $.Nestable = new Nestable, $.Nestable.Constructor = Nestable
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Nestable.init()
}(window.jQuery);
