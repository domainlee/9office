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
                'description' => 'Banner trên cùng'
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
            'endAnhGioiThieuBenTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTienIchDuAn' => array(
                'type' => 'startmodule',
                'label' => 'Tiện ích dự án'
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
            'endTienIchDuAn' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

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

            /**** start *****/
            'startBannerTrai' => array(
                'type' => 'startmodule',
                'label' => 'Banner trái'
            ),
            'Tiêu đề banner trái' => array(
                'type' => 'text',
            ),
            'Mô tả banner trái' => array(
                'type' => 'textarea',
            ),
            'Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 5,
            ),
            'endBannerTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startVideo' => array(
                'type' => 'startmodule',
                'label' => 'Video'
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
            'endVideo' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startEmail' => array(
                'type' => 'startmodule',
                'label' => 'Email'
            ),
            'Tiêu đề email' => array(
                'type' => 'text',
            ),
            'Mô tả email' => array(
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