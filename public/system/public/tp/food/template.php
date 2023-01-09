<?php
    $a = array(
        'Trang chủ' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 8,
            ),
        ),
        'Header' => array(
            'Văn bản đầu trang phải' => array(
                'type' => 'textarea'
            ),
        ),
        'Footer' => array(
            'Logo Footer' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),

        ),
    );

    return $a;
?>