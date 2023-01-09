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
    'Giới thiệu ' => array(
        'label' => 'Giới thiệu',
        'type' => 'multifield',
        'keyData' => 'intro-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'intro-title',
            ),
            'Nội dung' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'intro-image'
            ),
        ),
    ),
    'Banner nhỏ' => array (
        'label' => 'Banner nhỏ',
        'type' => 'multifield',
        'keyData' => 'small-banner-layout',
        'field' => array(
            'Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'keyData' => 'small-banner-list',
            ),
        ),
    ),
    '3 cột thông tin' => array(
        'label' => 'Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'info-layout',
        'field' => array(
            'Hình ảnh cột 1' => array(
                'type' => 'file',
                'keyData' => 'info-image-1',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-title-1',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-content-1',
            ),
            'Đường dẫn cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-link-1'
            ),
            'Hình ảnh cột 2' => array(
                'type' => 'file',
                'keyData' => 'info-image-2',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-title-2',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-content-2',
            ),
            'Đường dẫn cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-link-2'
            ),
            'Hình ảnh cột 3' => array(
                'type' => 'file',
                'keyData' => 'info-image-3',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-title-3',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-content-3',
            ),
            'Đường dẫn cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-link-3'
            ),
        ),
    ),
    'Sản phẩm nổi bật' => array(
        'label' => 'Sản phẩm nổi bật',
        'type' => 'multifield',
        'keyData' => 'feature-product',
        'field' => array(
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'feature-product-title',
            ),
            'Sản phẩm' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 1,
                'keyData' => 'feature-product-list',
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
    'Tin tức' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'news-slider-checkbox',
            ),
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'news-title',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 12,
                'keyData' => 'news-list',
            ),

        ),
    ),
    'Ảnh quảng cáo' => array (
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