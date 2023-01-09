<?php
    $a = array(
        'Trang chủ' => array(
//            'Danh mục sản phẩm' => array(
//                'type' => 'selectmulti',
//                'name' => 'categoryproduct',
//                'limit' => 8,
//            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 8,
            ),
            '6 Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 6,
            ),
            '1 Banner lớn' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),

            'category1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
            ),
            'Phản hồi khách hàng' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'news' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
        ),
        'Header' => array(
            'option1' => array(
                'type' => 'text',
                'value' => '',
            ),
            'option2' => array(
                'type' => 'text',
                'value' => '',
            ),
        ),

        'Footer' => array(
            'phone' => array(
                'type' => 'text',
            ),
            'Email' => array(
                'type' => 'text',
            ),
            'Cửa hàng' => array(
                'type' => 'textarea',
            ),
            'Chính sách mua hàng' => array(
                'type' => 'textarea',
            ),
            'Liên hệ với chúng tôi' => array(
                'type' => 'textarea',
            ),
        ),
    );

    return $a;
?>