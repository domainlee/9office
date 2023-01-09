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
    'Banner nhỏ' => array (
        'label' => 'Banner nhỏ',
        'type' => 'multifield',
        'keyData' => 'small-banner-layout',
        'field' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 4,
                'keyData' => 'small-banner-list',
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
        ),
    ),
    'Tab Sản phẩm' => array (
        'label' => 'Tab sản phẩm',
        'type' => 'multifield',
        'keyData' => 'tab-product-layout',
        'field' => array (
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'tab-product-title',
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
                'keyData' => 'tab1-title',
            ),
            'Sản phẩm tab 1' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product1',
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'keyData' => 'tab2-title',
            ),
            'Sản phẩm tab 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product2',
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'keyData' => 'tab3-title',
            ),
            'Sản phẩm tab 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product3',
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
    'Phản hồi của khách hàng' => array(
        'label' => 'Phản hồi của khách hàng',
        'type' => 'multifield',
        'keyData' => 'feedback-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'feedback-title',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'feedback-background',
            ),
            'Ảnh đại diện khách hàng 1' => array(
                'type' => 'file',
                'keyData' => 'avatar-1',
            ),
            'Tên khách hàng 1' => array(
                'type' => 'text',
                'keyData' => 'name-1',
            ),
            'Nội dung phản hồi của khách hàng 1' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-1',
            ),
            'Ảnh đại diện khách hàng 2' => array(
                'type' => 'file',
                'keyData' => 'avatar-2',
            ),
            'Tên khách hàng 2' => array(
                'type' => 'text',
                'keyData' => 'name-2',
            ),
            'Nội dung phản hồi của khách hàng 2' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-2',
            ),
            'Ảnh đại diện khách hàng 3' => array(
                'type' => 'file',
                'keyData' => 'avatar-3',
            ),
            'Tên khách hàng 3' => array(
                'type' => 'text',
                'keyData' => 'name-3',
            ),
            'Nội dung phản hồi của khách hàng 3' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-3',
            ),
            'Ảnh đại diện khách hàng 4' => array(
                'type' => 'file',
                'keyData' => 'avatar-4',
            ),
            'Tên khách hàng 4' => array(
                'type' => 'text',
                'keyData' => 'name-4',
            ),
            'Nội dung phản hồi của khách hàng 4' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-4',
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