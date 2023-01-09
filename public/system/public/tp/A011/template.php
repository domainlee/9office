<?php
/************/
// Chú thích
// Banner là một key trong array, có type là selectmulti, kiểu dữ liệu 'banner' (banner, news, product, page).
// Kiểm tra module hide/show
// label => 'Banner'
// kiểm tra view_banner, với module khác view_gioi-thieu
// //
/************/
    $a = array (
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
            'startGioithieu' => array(
                'type' => 'startmodule',
                'label' => 'Giới thiệu'
            ),
            'Ảnh giới thiệu bên trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
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
            'endGioithieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start ****/
            'startTienich' => array(
                'type' => 'startmodule',
                'label' => 'Tiện ích dự án'
            ),
            'Tiêu đề tiện ích dự án' => array(
                'type' => 'text',
            ),
            'Tiện ích dự án' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 9,
            ),
            'endTienich' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start ****/
            'startTintuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức'
            ),
            'Tiêu đề tin tức' => array(
                'type' => 'text',
            ),
            'Tin tức' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 9,
            ),
            'endTintuc' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start ****/
            'start4' => array(
                'type' => 'startmodule',
                'label' => '2 hàng 4 cột'
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
            'end4' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start ****/
            'startVideo' => array(
                'type' => 'startmodule',
                'label' => 'Video'
            ),
            'Tiêu đề video' => array(
                'type' => 'text',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.'
            ),
            'endVideo' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start ****/
            'startEmail' => array(
                'type' => 'startmodule',
                'label' => 'Email'
            ),
            'Tiêu đề email' => array(
                'type' => 'text',
            ),
            'endEmail' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/
        ),
        'Sidebar tin tức' => array(
            /**** start *****/
            'startDanhMuc1' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục sidebar 1'
            ),
            'Tiêu đề danh mục tin tức 1' => array(
                'type' => 'text',
            ),
            'Bài viết danh mục 1' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endDanhMuc1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDanhMuc2' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục sidebar 2'
            ),
            'Tiêu đề danh mục tin tức 2' => array(
                'type' => 'text',
            ),
            'Bài viết danh mục 2' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endDanhMuc2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBannerSidebar' => array(
                'type' => 'startmodule',
                'label' => 'Banner sidebar'
            ),
            'Banner sidebar' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endBannerSidebar' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/
        ),
        'Footer' => array(
            'Giới thiệu footer' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề thông tin bên phải' => array(
                'type' => 'text',
            ),
            'Thông tin bên phải' => array(
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
    );

    return $a;
?>