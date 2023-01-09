<?php
    $a = array(
        'Home Page' => array(
            'Dự án tiêu biểu' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 6,
            ),
            'Video' => array(
                'type' => 'text',
            ),
        ),
        'Footer' => array(
            'hotline' => array(
                'type' => 'text',
            ),
            'Chia sẻ' => array(
                'type' => 'textarea',
            ),
        ),
        'Dashboard' => array(
            'Bài viết blog' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 6,
            ),
        )
    );
    return $a;
?>