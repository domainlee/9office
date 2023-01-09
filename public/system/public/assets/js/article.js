/**
 * Created by mienle on 5/11/17.
 */

$(function(){
    $('.changeType').click(function(){
        var id = $(this).attr('data-id'), _this = $(this);
        $.post('/admin/product/changec',{id: id},function(r){
            if(r.code == 1){
                if(r.status == 1){
                    _this.find('i').remove();
                    _this.append('<i class="fa fa-eye"></i>');
                }else if(r.status == 0){
                    _this.find('i').remove();
                    _this.append('<i class="fa fa-eye-slash"></i>');
                }
            }else if(r.code == 0){
                alert(r.messenger);
            }
        });
    });

    $('.updateOrder').click(function(){
        var id = $(this).attr('data-id'), _this = $(this);
        $.post('/admin/product/changec',{id: id, order: true},function(r){
            if(r.code == 1){
                location.reload();
            }else if(r.code == 0){
                alert(r.messenger);
            }
        });
    });

    var hide = true;
    var t = $('.deleteCategory');
    var clicks = true;

    t.click(function() {
        var t = $(this);
        var td = t.closest('tr');
        if (clicks) {
            $(this).text('OK');
            $(this).removeClass('fa fa-trash-o');
            clicks = false;
        } else {
            $.post('/admin/product/deletecategory',{
                id: $(this).attr('data-id'),
            },function(r){
                if(r.code == 0){
                    alert('We are can not find product on system');
                }else if(r.code == 1){
                    td.fadeOut(600,function(){
                        td.remove();
                    });
                }
            });
            clicks = true;
        }
    });

    $('html').click(function(e){
        if ($(e.target).hasClass('deleteCategory')) {
            return false;
        }
        if(hide){
            t.addClass('fa fa-trash-o').text('');
        }
        clicks = true;
        hide = true;
    });

});