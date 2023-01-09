<?php
$home = array(
    'Tin tức đầu trang' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'highlight-news-layout',
        'field' => array (
            'Bài viết nổi bật' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 1,
                'keyData' => 'highlight-news',
            ),
            '4 Bài viết bên dưới' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 4,
                'keyData' => 'four-news-below',
            ),
            '8 Bài viết bên phải' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 8,
                'keyData' => 'eight-news-right'
            ),

        ),
    ),
    'Danh mục tin tức' => array(
        'label' =>  'Damh mục tin tức',
        'type' => 'multifield',
        'keyData' => 'news-category-layout',
        'field' => array(
            'Danh mục' => array(
                'type' => 'selectmulti',
                'name' => 'newscategory',
                'limit' => 10,
                'keyData' => 'news-category',
            ),
        ),
    ),
    'Ảnh quảng cáo đầu trang' => array (
        'label' => 'Ảnh quảng cáo',
        'type' => 'multifield',
        'keyData' => 'top-image-layout',
        'field' => array (
            'Chọn ảnh' => array(
                'type' => 'file',
                'keyData' => 'top-promote-image',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'top-image-link',
            ),
        ),
    ),
    'Ảnh quảng cáo giữa trang' => array (
        'label' => 'Ảnh quảng cáo',
        'type' => 'multifield',
        'keyData' => 'image-layout',
        'field' => array (
            'Chọn ảnh' => array(
                'type' => 'file',
                'keyData' => 'promote-image',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'image-link',
            ),
        ),
    ),
    'Soạn thảo' => array (
        'label' => 'Soạn thảo',
        'type' => 'multifield',
        'keyData' => 'option-layout',
        'field' => array (
            'HTML' => array (
                'type' => 'texteditor',
                'keyData' => 'option-html',
            ),
        ),
    ),
    'HTML/CSS' => array(
        'label' => 'HTML/CSS',
        'type' => 'multifield',
        'keyData' => 'html-layout',
        'field' => array(
            'HTML/CSS' => array (
                'type' => 'editorhtml',
                'keyData' => 'editor-html-description',
            ),
        )
    ),
);
return $home;
?>