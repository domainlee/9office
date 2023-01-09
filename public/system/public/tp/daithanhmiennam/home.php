<?php
$home = array(
    'Slider' => array (
        'label' => 'Slider',
        'type' => 'multifield',
        'keyData' => 'slider-layout',
        'field' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 8,
                'keyData' => 'banner-list',
            ),
        ),
        'image' => '/tp/f001/screenshort/',
    ),
    '3 Hỗ trợ khách hàng' => array(
        'label' => '3 Hỗ trợ khách hàng',
        'type' => 'multifield',
        'keyData' => 'tool-layout',
        'field' => array(
            'Nội dung' => array(
                'type' => 'textarea',
                'keyData' => 'tool-content',
            ),
        ),
    ),
    'Banner nhỏ' => array (
        'label' => 'Banner nhỏ',
        'type' => 'multifield',
        'keyData' => 'small-banner-layout',
        'field' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
                'keyData' => 'small-banner-list',
            ),
        ),
    ),

    '4 Nội dung' => array(
        'label' => '4 Nội dung',
        'type' => 'multifield',
        'keyData' => 'four-layout',
        'field' => array(
            'Tiêu đề 1' => array(
                'type' => 'text',
                'keyData' => 'intro-title-1',
            ),
            'Nội dung 1' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content-1',
            ),
            'Tiêu đề 2' => array(
                'type' => 'text',
                'keyData' => 'intro-title-2',
            ),
            'Nội dung 2' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content-2',
            ),
            'Tiêu đề 3' => array(
                'type' => 'text',
                'keyData' => 'intro-title-3',
            ),
            'Nội dung 3' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content-3',
            ),
            'Tiêu đề 4' => array(
                'type' => 'text',
                'keyData' => 'intro-title-4',
            ),
            'Nội dung 4' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content-4',
            ),
        ),
    ),
    'Danh mục sản phẩm' => array (
        'label' => 'Danh mục sản phẩm',
        'type' => 'multifield',
        'keyData' => 'product-layout',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'product-title',
            ),
            'Danh mục sản phẩm' => array(
                'type' => 'selectmulti',
                'name' => 'productcategory',
                'limit' => 8,
                'keyData' => 'product-category',
            ),
        ),
    ),
    'Danh sách sản phẩm' => array (
        'label' => 'Danh mục sản phẩm',
        'type' => 'multifield',
        'keyData' => 'list-product-layout',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'list-product-title',
            ),
            'Danh mục sản phẩm' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
                'keyData' => 'list-product-category',
            ),
        ),
    ),
    'Tin tức' => array (
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
                'limit' => 15,
                'keyData' => 'news-list',
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