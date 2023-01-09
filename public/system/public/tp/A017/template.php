<?php
/************/
// Chú thích
// Banner là một key trong array, có type là selectmulti, kiểu dữ liệu 'banner' (banner, news, product, page).
// //
/************/
    $a = array(
        'Trang chủ' => array(
            /**** start *****/
            'startBanner' => array(
                'type' => 'startmodule',
                'label' => 'Banner'
            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startAnhGioiThieuBenTrai' => array(
                'type' => 'startmodule',
                'label' => 'Ảnh giới thiệu bên trái'
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
            'endAnhGioiThieuTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startAnhGioiThieuBenTrai2' => array(
                'type' => 'startmodule',
                'label' => 'Ảnh giới thiệu bên trái 2'
            ),
            'Ảnh giới thiệu bên trái 2' => array(
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
            'endAnhGioiThieuBenTrai2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaProject' => array(
                'type' => 'startmodule',
                'label' => 'Ba project'
            ),
            'Tiêu đề 3 project ' => array(
                'type' => 'text',
            ),
            'Mô tả ngắn 3 project ' => array(
                'type' => 'text',
            ),
            'Ba project' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'end3Project' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/
           /* 'Thống kê số project' => array(
                'type' => 'text'
            ),
            'Thống kê số giải thưởng' => array(
                'type' => 'text'
            ),
            'Thống kê số khách hàng' => array(
                'type' => 'text'
            ),
            'Thống kê số tiêu thụ' => array(
                'type' => 'text'
            ),
            'Ảnh background 3 danh muc' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),*/

            /**** start *****/
            'startTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức'
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
            'endTinTuc' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/
            /*'Các công việc nổi bật' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 6,
            ),*/
            'Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
                'description' => '2 Banner slider'
            ),
            'Tiêu đề banner trái' => array(
                'type' => 'text',
            ),
            'Mô tả banner trái' => array(
                'type' => 'textarea',
            ),
            'Đường dẫn banner trái' => array(
                'type' => 'text',
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
            'Đường dẫn banner phải' => array(
                'type' => 'text',
            ),
            'Tiêu đề video' => array(
                'type' => 'text',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.'
            ),
            'Tiêu đề email' => array(
                'type' => 'text',
            ),


        ),
        'Footer' => array(
            'Logo Footer' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Giới thiệu footer' => array(
                'type' => 'textarea',
            ),
            'Địa chỉ footer' => array(
                'type' => 'textarea',
            ),
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