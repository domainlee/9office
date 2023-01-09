<?php
    $a = array(
        'Home Page' => array(
            'Dự án tiêu biểu' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 6,
                'title' => '',
                'value' => '',
            ),
        ),
        'Chi tiết bài viết' => array(
            'Tiêu đề khuyến mãi danh mục' => array(
                'type' => 'text'
            ),
            'Tiêu đề khuyến mãi' => array(
                'type' => 'text'
            ),
            'Tiêu đề button' => array(
                'type' => 'text'
            )
        ),
        'Footer' => array(
            'Chia sẻ' => array(
                'type' => 'textarea',
            ),
        ),
        'Dashboard' => array(
            'Bài viết dashboard' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 6,
            ),
            'Bài viết trang chủ' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
        )

    );

    return $a;
?>