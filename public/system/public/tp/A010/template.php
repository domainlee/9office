<?php
    $a = array(
        'Trang chủ' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 10,
            ),
            'Giới thiệu đầu' => array(
                'type' => 'textarea',
            ),
            'Tin tức' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'Thư viện' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 9,
            ),
            'Nội thất và kiến trúc' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 4,
            ),
            'Xây nhà chọn gói' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 2,
            ),
            'Biệt thự lâu đài' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'Youtube giới thiệu' => array(
                'type' => 'text',
            ),
        ),
        'Header' => array(
            'Email' => array(
                'type' => 'text',
            ),
            'Số điện thoại' => array(
                'type' => 'text',
            ),
        ),
        'Sidebar' => array(
            'Bài viết gần đây sidebar' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
                'description' => 'Bài viết gần đây sidebar'
            ),
            'Nhiều người quan tâm' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
                'description' => 'Bài viết nhiều người quan tâm sidebar'
            ),
            'Quảng cáo sidebar' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
        ),
        'Footer' => array(
            'Giới thiệu' => array(
                'type' => 'textarea',
            ),
            'Bài viết gần đây' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
                'description' => 'Bài viết gần đây footer'
            ),
            'Copyright' => array(
                'type' => 'text',
            ),
            'Youtube' => array(
                'type' => 'text',
            ),
            'Google' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
            ),
            'Twitter' => array(
                'type' => 'text',
            ),

        ),
    );

    return $a;
?>