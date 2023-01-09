<?php
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
                'limit' => 1,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startGioiThieu' => array(
                'type' => 'startmodule',
                'label' => 'Giới thiệu'
            ),
            'Giới thiệu' => array(
                'type' => 'selectmulti',
                'name' => 'page',
                'limit' => 1,
            ),
            'endGioiThieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaBannerTrai' => array(
                'type' => 'startmodule',
                'label' => '3 Banner trái'
            ),
            '3 Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'description' => 'Hai banner nhỏ trái, 1 banner lớn bên phải'
            ),
            'endBaBannerTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaBannerPhai' => array(
                'type' => 'startmodule',
                'label' => '3 Banner phải'
            ),
            '3 Banner phải' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'description' => 'Một banner lớn bên trái, 2 banner nhỏ bên phải'
            ),
            'endBaBannerPhai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDichVu' => array(
                'type' => 'startmodule',
                'label' => 'Dịch vụ'
            ),
            'Tiêu đề dịch vụ' => array(
                'type' => 'text',
                'description' => 'Tiêu đề và 3 cột dịch vụ'
            ),
            'Dịch vụ' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'endDichVu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startPhanHoi' => array(
                'type' => 'startmodule',
                'label' => 'Phản hồi'
            ),
            'Tiêu đề phản hồi' => array(
                'type' => 'text',
                'description' => 'Tiêu đề và slider phản hồi'
            ),
            'Phản hồi' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endPhanHoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBannerDoiTac' => array(
                'type' => 'startmodule',
                'label' => 'Banner đối tác'
            ),
            'Tiêu đề banner đối tác' => array(
                'type' => 'text',
                'description' => 'Tiêu đề đối tác, và banner đối tác, chọn tối đa 8 banner'
            ),
            'Banner đối tác' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 8,
            ),
            'endBannerDoiTac' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

        ),
        'Header' => array(
            'Văn bản đầu trang phải' => array(
                'type' => 'textarea'
            ),
        ),
        'Footer' => array(
            'Bản đồ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Địa chỉ' => array(
                'type' => 'textarea',
            ),
            'Điện thoại' => array(
                'type' => 'textarea',
            ),
            'Email' => array(
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