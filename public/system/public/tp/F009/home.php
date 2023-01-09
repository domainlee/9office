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
    ),
    'Sản phẩm' => array (
        'label' => 'Sản phẩm',
        'type' => 'multifield',
        'keyData' => 'product-layout',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'product-slider-checkbox',
            ),
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'product-title',
            ),
            'Sản phẩm' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
                'keyData' => 'product-list',
            ),
            'Đường dẫn button' => array(
                'type' => 'text',
                'keyData' => 'product-link',
            ),
        ),
    ),
    'Tin tức' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'news-slider-checkbox',
            ),
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
    'Gallery' => array(
        'label' => 'Gallery',
        'type' => 'multifield',
        'keyData' => 'gallery-layout',
        'field' => array(
            'Ảnh 1' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-1',
            ),
            'Ảnh 2' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-2',
            ),
            'Ảnh 3' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-3',
            ),
            'Ảnh 4' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-4',
            ),
            'Ảnh 5' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-5',
            ),
            'Ảnh 6' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-6',
            ),
            'Ảnh 7' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-7',
            ),
            'Ảnh 8' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-8',
            ),
            'Ảnh 9' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-9',
            ),
            'Ảnh 10' => array(
                'type' => 'file',
                'keyData' => 'gallery-img-10',
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