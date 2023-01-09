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
            '3 Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
            ),
//            'Page' => array(
//                'type' => 'selectmulti',
//                'name' => 'page',
//                'limit' => 8,
//            ),
            'Title Category 1' => array(
                'type' => 'text',
                'value' => '',
            ),
            'category1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
            ),
            'Title Category 2' => array(
                'type' => 'text',
                'value' => '',
            ),
            'category2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
            ),
            'Title Sales' => array(
                'type' => 'text',
                'value' => '',
            ),
            'sales' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
            ),
            'Title News' => array(
                'type' => 'text',
                'value' => '',
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