/**
 * Created by mienle on 6/3/17.
 */

jQuery(document).ready(function($) {

    $('.summernote').summernote({
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        height: 350,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,                 // set focus to editable area after initializing summernote
        lang: "vi-VN",
        callbacks: {
            onImageUpload: function (image) {
                sendFile(image[0]);
            }
        },
        imageAttributes:{
            icon:'<i class="note-icon-pencil"/>',
            removeEmpty:false, // true = remove attributes | false = leave empty if present
            disableUpload: false // true = don't display Upload Options | Display Upload Options
        },
    });

    $('.summernote-small').summernote({
        popover: {
            image: [
                ['custom', ['imageAttributes']],
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
        },
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,                 // set focus to editable area after initializing summernote
        lang: "vi-VN",
        imageAttributes:{
            icon:'<i class="note-icon-pencil"/>',
            removeEmpty:false, // true = remove attributes | false = leave empty if present
            disableUpload: false // true = don't display Upload Options | Display Upload Options
        },
        callbacks: {
            onImageUpload: function (image) {
                sendFile(image[0]);
            }
        }
    });

    $('form').parsley();

    $('.counter').counterUp({
        delay: 100,
        time: 1200
    });

    $(".knob").knob();

    $('.autonumber').autoNumeric('init', {'mDec':0});

    function sendFile(image) {
        var data = new FormData();
        data.append("imagemulti[]", image);
        $.ajax({
            data: data,
            type: "POST",
            url: "/admin/media/upload",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('.summernote').summernote("insertImage", data.url);
            }
        });
    }

});