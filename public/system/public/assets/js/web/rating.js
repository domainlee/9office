/**
 * Created by mienle on 1/29/19.
 */
$(function() {
    function getScriptForm() {
        $('form').parsley();
        (function($) {
            $.fn.clickToggle = function(func1, func2) {
                var funcs = [func1, func2];
                this.data('toggleclicked', 0);
                this.click(function() {
                    var data = $(this).data();
                    var tc = data.toggleclicked;
                    $.proxy(funcs[tc], this)();
                    data.toggleclicked = (tc + 1) % 2;
                });
                return this;
            };
        }(jQuery));

        var bodyRating = $('.rating-comment-crt');
        var t = $('.rating-comment-crt__button a');

        t.clickToggle(function(){
            bodyRating.addClass('rating-comment-crt__open');
            t.text('Đóng');
        }, function(){
            bodyRating.removeClass('rating-comment-crt__open rating-comment-crt__open--box');
            t.text('Gửi đánh giá');
        });

        var labelRating = $('.rating-comment-crt__comment--label');
        $('#stars li').on('mouseover', function(){
            labelRating.css({'display': 'block'});
            var dataValue = $(this).attr('data-value');
            var title = $(this).attr('title');
            var onStar = parseInt($(this).data('value'), 10);
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                    labelRating.text(title);
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
                labelRating.css({'display': 'none'});
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var msg = "";
                if (ratingValue > 0) {
                    labelRating.css({'display': 'block'});
                    bodyRating.addClass('rating-comment-crt__open--box');
                    $('.rating-comment-crt__vote').val(ratingValue);
                }
            });
        });

        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }
            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
                bodyRating.addClass('rating-comment-crt__open--box');
            }
        });

        $('.rating-comment-crt__form').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var dataArray = $(this).serializeArray();
            var result = {};

            $.each(dataArray, function() {
                result[this.name] = this.value;
            });

            if ( $(this).parsley().isValid() ) {
                $.post('/rating', data, function (e) {
                    if(e.code == 1) {
                        alert(e.messenger);
                        t.text('Gửi đánh giá');
                        bodyRating.removeClass('rating-comment-crt__open rating-comment-crt__open--box');
                        $.post('/rating', {'itemId' : result.itemId, 'type': result.type, 'template': 'layout/ratingReport', 'terminal': true}, function (r) {
                            bodyRating.html(r);
                            $.getScript(getScriptForm());
                        });
                    } else if (e.code == 0) {
                        alert(e.messenger);
                    }
                });
            }
        });
    }

    getScriptForm();


});