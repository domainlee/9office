/**
 * Created by mienle on 5/27/17.
 */
$(function () {
    $('form').parsley();


    $('.support__form').submit(function(e) {
        var phone_ = $(this).find('input').val();

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post('/contactajax', {'phone': phone_}, function (e) {
                if(e.code == 1) {
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    location.reload();
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });

    $('.support-module__form').submit(function(e) {
        var phone_ = $(this).find('input').val();
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post('/contactajax', {'phone': phone_}, function (e) {
                if(e.code == 1) {
                    alert('Cảm ơn bạn đã để lại phản hồi, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                    location.reload();
                } else if (e.code == 0) {
                    alert('Dữ liệu chưa phù hợp.');
                }
            });
        }
    });


});