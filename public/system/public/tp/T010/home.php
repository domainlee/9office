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
            'Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 2,
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
                'limit' => 10,
                'keyData' => 'product-list',
            ),
            'Danh mục liên quan' => array(
                'type' => 'selectmulti',
                'name' => 'productcategory',
                'limit' => 6,
                'keyData' => 'product-category',
            ),
        ),
    ),
    'Sản phẩm 2' => array (
        'label' => 'Sản phẩm',
        'type' => 'multifield',
        'keyData' => 'product-layout-2',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'product-slider-checkbox-2',
            ),
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'product-title-2',
            ),
            'Sản phẩm' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
                'keyData' => 'product-list-2',
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
    'Ý kiến khách hàng & Form liên hệ' => array(
        'label' => 'Ý kiến khách hàng & Form liên hệ',
        'type' => 'multifield',
        'keyData' => 'feedback-form-layout',
        'field' => array(
            'Tiêu đề phản hồi' => array(
                'type' => 'text',
                'keyData' => 'feedback-title',
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
            'Tiêu đề Form liên hệ' => array(
                'type' => 'text',
                'keyData' => 'support-title',
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