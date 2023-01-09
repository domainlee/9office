<?php
/************/
// Chú thích
// Banner là một key trong array, có type là selectmulti, kiểu dữ liệu 'banner' (banner, news, product, page).
// //
/************/
    $a = array(
        'Trang chủ' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
                'description' => 'Banner trên cùng'
            ),

            'Ảnh giới thiệu bên trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
                'description' => 'Giới thiệu bên trái là ảnh, bên phải mô tả'
            ),
            'Tiêu đề giới thiệu' => array(
                'type' => 'text',
            ),
            'Nội dung giới thiệu' => array(
                'type' => 'textarea',
            ),
            'Đường dẫn giới thiệu' => array(
                'type' => 'text',
            ),
            'Tiêu đề tiện ích dự án' => array(
                'type' => 'text',
                'description' => '9 tiện ích dự án'
            ),
            'Mô tả tiện ích dự án' => array(
                'type' => 'text',
            ),
            'Tiện ích dự án' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 9,
            ),
            'Tiêu đề tin tức' => array(
                'type' => 'text',
                'description' => '4 bài viết'
            ),
            'Mô tả tin tức' => array(
                'type' => 'text',
            ),
            'Tin tức' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 9,
            ),
            'Tiêu đề hình ảnh' => array(
                'type' => 'text',
                'description' => 'Hình ảnh slider'
            ),
            'Mô tả hình ảnh' => array(
                'type' => 'text',
            ),
            'Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
            ),
            'Tiêu đề banner trái' => array(
                'type' => 'text',
            ),
            'Mô tả banner trái' => array(
                'type' => 'textarea',
            ),
            'Banner phải' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
            ),
            'Tiêu đề banner phải' => array(
                'type' => 'text',
            ),
            'Mô tả banner phải' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề video' => array(
                'type' => 'text',
            ),
            'Mô tả video' => array(
                'type' => 'text',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.'
            ),
            'Tiêu đề email' => array(
                'type' => 'text',
            ),
            'Mô tả email' => array(
                'type' => 'text',
            ),
        ),
        'Footer' => array(
            'Copyright' => array(
                'type' => 'text',
            ),
            'Youtube' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
            ),
            'Twitter' => array(
                'type' => 'text',
            ),
            'Instagram' => array(
                'type' => 'text',
            ),
            'Pinterest' => array(
                'type' => 'text',
            ),

        ),
        'Script' => array(
            'Script footer' => array(
                'type' => 'textarea',
            ),
            'Script header first' => array(
                'type' => 'textarea',
            ),
            'Script in body' => array(
                'type' => 'textarea',
            ),
        )
    );

    return $a;
?>