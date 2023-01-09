<?php
    $a = array(
        'Trang chủ' => array(
            /**** start *****/
            'startBanner' => array(
                'type' => 'startmodule',
                'label' => 'Banner bài viết'
            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 1,
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
        ),
        'Footer' => array(
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
    );

    return $a;
?>