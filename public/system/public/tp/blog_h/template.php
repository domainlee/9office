<?php
    $a = array(
        'Head' => array(
            'Tiêu đề head' => array(
                'type' => 'text',
            ),
            'Tóm tắt head' => array(
                'type' => 'textarea',
            ),
            'Ảnh đại diện head' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
        ),
        'Sidebar mô tả' => array(
            'Ảnh đại diện' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Tiêu đề' => array(
                'type' => 'text',
            ),
            'Tóm tắt' => array(
                'type' => 'textarea',
            ),
        ),
        'Sidebar bài viết' => array(
            'Tiêu đề 2' => array(
                'type' => 'text',
            ),
            'Bài viết dashboard' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
        ),
        'Footer' => array(
            'Facebook' => array(
                'type' => 'text',
            ),
            'Google' => array(
                'type' => 'text',
            ),
            'Instagram' => array(
                'type' => 'text',
            ),
        ),


    );

    return $a;
?>