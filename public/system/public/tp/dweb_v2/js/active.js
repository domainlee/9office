$(function(){
    var submit = true;
    var _key = $('.keyActive').val();

    $.ajax({
        xhr: function() {
            submit = true;
            var xhr = new window.XMLHttpRequest();
            xhr.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    console.log(percentComplete);
                }
            }, false);
            return xhr;
        },
        data: jQuery.param({'active': true}),
        type: "POST",
        url: '/active/'+_key,
        cache: false,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: false,
        success: function(url) {
            if(url.code == 1) {
                submit = false;
                window.location.href = 'http://'+url.domain;
            }
        },
        error: function () {
            submit = false;
            window.location.href = 'http://dweb.vn';
        }
    });

    $(window).bind("beforeunload",function(event) {
        if(submit){
            return "Bạn chắc chắn rằng muốn huỷ dữ liệu.";
        }
    });





});