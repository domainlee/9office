<?php
    $home = array(
        'Slider bài viết' => array (
            'label' => 'Tin tức',
            'type' => 'multifield',
            'keyData' => 'news-layout',
            'field' => array (
                'Tiêu đề' => array (
                    'type' => 'text',
                    'keyData' => 'news-title',
                ),
                'Tin tức' => array (
                    'type' => 'selectmulti',
                    'name' => 'news',
                    'limit' => 8,
                    'keyData' => 'news-list',
                ),

            ),
        ),
    );
    return $home;
?>