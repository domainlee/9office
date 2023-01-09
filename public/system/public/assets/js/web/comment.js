/**
 * Created by mienle on 2/20/19.
 */
$(function() {
    var boxCommentTwo = $('.box-comment__item--two');
    var boxCommentButton = $('.box-comment__button');

    $('.box-comment__content--js').click(function(){
        boxCommentTwo.fadeIn();
        boxCommentButton.fadeIn();
    });

    $('.form__comment').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var dataArray = $(this).serializeArray();
        var result = {};
        var commentList = $('.box-comment__list');

        $.each(dataArray, function() {
            result[this.name] = this.value;
        });

        if ( $(this).parsley().isValid() ) {
            $.post('/comment', data, function (e) {
                if(e.code == 1) {
                    alert(e.messenger);
                    $.post('/listcomment', {'itemId' : result.itemId, 'type': result.type, 'template': 'layout/commentlist', 'terminal': true}, function (r) {
                        commentList.html(r);
                    });
                } else if (e.code == 0) {
                    alert(e.messenger);
                }
            });
        }
    });


});