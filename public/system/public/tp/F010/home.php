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
            'Hình ảnh' => array(
                'type' => 'file',
                'keyData' => 'intro-image'
            ),
            'Đường dẫn của hình ảnh' => array(
                'type' => 'text',
                'keyData' => 'intro-link',
            )
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
    'Đếm ngược' => array(
        'label' => 'Đếm ngược',
        'type' => 'multifield',
        'keyData' => 'countdown-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'countdown-title',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'countdown-background',
            ),
            'Ngày' => array(
                'type' => 'text',
                'keyData' => 'countdown-days',
            ),
            'Tháng' => array(
                'type' => 'text',
                'keyData' => 'countdown-months',
            ),
            'Năm' => array(
                'type' => 'text',
                'keyData' => 'countdown-years',
            ),
            'Giờ' => array(
                'type' => 'text',
                'keyData' => 'countdown-hours',
            ),
            'Phút' => array(
                'type' => 'text',
                'keyData' => 'countdown-minutes',
            ),
            'Giây' => array(
                'type' => 'text',
                'keyData' => 'countdown-seconds',
            ),
        )
    ),
    'Video' => array(
        'label' => 'Video',
        'type' => 'multifield',
        'keyData' => 'video-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'video-title',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'video-background',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.',
                'keyData' => 'video-url',
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
    'Form liên hệ' => array (
        'label' => 'Form liên hệ',
        'type' => 'multifield',
        'keyData' => 'support-layout',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'support-title',
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
                'keyData' => 'promote-link',
            ),
        ),
    ),

);
return $home;
?>