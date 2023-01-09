$(function(){
    
    $('.lazy').Lazy({
        effect: "fadeIn",
        effectTime: 500,
    });

    var buttonChoose = $('.project__button-choose');
    var _modal = $('#modalGlobal');
    var _modalChoose = $('#chooseTheme');
    var _modalChooseContent = _modalChoose.find('.modal-content');

    buttonChoose.click(function() {
        var t = $(this);
        var themeId = t.attr('data-theme');
        $('.themeId').val(themeId);
        _modalChoose.modal();
    });

    var buttonSendCreated = $('.button-choose-template');

    buttonSendCreated.click(function(){
        var themeId = $('.themeId').val();
        if(themeId != '') {
            buttonSendCreated.text('Đang hoàn tất ...');
            $.post('/registerajax', {storeClone: themeId}, function (e) {
                if(e.code == 1) {
                    _modalChoose.on('hidden.bs.modal', function () {
                        location.reload();
                    });
                    window.location.href = e.active
                } else if(e.code == 0) {
                    _modalChoose.modal();
                    _modalChooseContent.html('<p>Đăng ký không thành công, xin vui lòng thử lại</p>')
                }
            });
        }
    });

    $('.created-website__form-js').submit(function(e) {
        var button = $(this).find('button');
        var data = $(this).serialize();
        var themeId = $('.themeId').val();
        var url = themeId ? '/created/'+themeId:'/created';
        var _modalChoose = $('#chooseTheme');
        var _modalChooseContent = _modalChoose.find('.modal-content');

        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            $.post(url, data, function (e) {
                if(e.code == 1) {
                    if(e.themeId && e.store) {
                        button.text('Đang hoàn tất đăng ký ...');
                        $.post('/registerajax', {}, function (r) {
                            if(r.code == 1) {
                                _modalChoose.on('hidden.bs.modal', function () {
                                    location.reload();
                                });
                                window.location.href = r.active
                                // button.text('Đăng ký thành công.');
                                // _modalChoose.modal();
                                // _modalChooseContent.html('<div><h3 class="choose-template__headline">Đăng ký thành công</h3><p>Chúng tôi có gửi một email vào tài khoản <strong>'+r.email+'</strong>, xin vui lòng đăng nhập email để kích hoạt tài khoản.</p></div>');
                                // _modalChoose.on('hidden.bs.modal', function () {
                                //     location.reload();
                                // });
                            } else if(r.code == 0) {
                                _modalChooseContent.html('<p>'+r.messenger+'</p>')
                            }
                        });
                    } else if(e.store) {
                        _modal.modal();
                        var _content = _modal.find('.modal-content');
                        _content.html('<div class="modal__headline">Chọn giao diện</div> Lựa chọn giao diện website mà bạn cần sử dụng. <br>Nhấn nút <a class="btn-d project__button-detail project__button-choose" data-theme="f004">Lựa chọn</a> để hoàn tất đăng ký. Đi đến <a href="'+e.redirect+'">kho giao diện.</a>');
                        _modal.on('hidden.bs.modal', function () {
                            window.location.href = e.redirect
                        });
                    } else {
                        location.reload();
                    }
                } else if (e.code == 0) {
                    _modal.modal();
                    var _content = _modal.find('.modal-content p');
                    _content.html(e.messenger)
                }

            });
        }
    });

    $('.created-website__store-input').keyup(function() {
        var t = $(this);
        var _title = t.val();
        var slug = ChangeToSlug(_title);
        $('.label__store').text(slug ? slug:'tendoanhnghiep');
        $('.created-website__store-input-hidden').val(slug);
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
        slug = slug.replace(/ /gi, "");
        slug = slug.replace(/\-\-\-\-\-/gi, '');
        slug = slug.replace(/\-\-\-\-/gi, '');
        slug = slug.replace(/\-\-\-/gi, '');
        slug = slug.replace(/\-\-/gi, '');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    }

    // var search = $('.created-website__email input[name="email"]');
    // var elementPassword = $('.created-website__password');
    // var elementPhone = $('.created-website__phone');
    //
    // var typingTimer;
    // var doneTypingInterval = 15000;
    //
    // search.on('keyup', function () {
    //     $.post('/user/checkemail', {'email': $(this).val()}, function(e){
    //         console.log(e);
    //     });
    // });

    var username = $('input[name="username"]');
    $('.signin-page__list li').each(function(){
        var a = $(this).find('a');
        a.click(function(){
            username.val($(this).attr('data-user'));
        });
    });

});