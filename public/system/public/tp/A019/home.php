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
    'Giới thiệu' => array(
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
                'keyData' => 'intro-image',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'intro-link',
            ),
        ),
    ),
    'Hình ảnh dự án' => array(
        'label' => 'Hình ảnh dự án',
        'type' => 'multifield',
        'keyData' => 'galery-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'galery-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'galery-sub-title',
            ),
            'Tiêu đề dự án 1' => array(
                'type' => 'text',
                'keyData' => 'galery-1-title',
            ),
            'Mô tả dự án 1' => array(
                'type' => 'textarea',
                'keyData' => 'galery-1-description',
            ),
            'Đường dẫn dự án 1' => array(
                'type' => 'text',
                'keyData' => 'galery-1-link',
            ),
            'Hình ảnh dự án 1' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 15,
                'keyData' => 'galery-1-list',
            ),
            'Tiêu đề dự án 2' => array(
                'type' => 'text',
                'keyData' => 'galery-2-title',
            ),
            'Mô tả dự án 2' => array(
                'type' => 'textarea',
                'keyData' => 'galery-2-description',
            ),
            'Đường dẫn dự án 2' => array(
                'type' => 'text',
                'keyData' => 'galery-2-link',
            ),
            'Hình ảnh dự án 2' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 15,
                'keyData' => 'galery-2-list',
            ),
        ),
    ),
    'Tiện ích dự án' => array(
        'label' => 'Tiện ích dự án',
        'type' => 'multifield',
        'keyData' => 'project-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'project-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'project-sub-title'
            ),
            'Dự án' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 8,
                'keyData' => 'project-list',

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
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'news-sub-title',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 8,
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
    'Video' => array(
        'label' => 'Video',
        'type' => 'multifield',
        'keyData' => 'video-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'video-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'video-sub-title',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.',
                'keyData' => 'video-url',
            ),
        ),
    ),
    'Form liên hệ' => array(
        'label' => 'Form liên hệ',
        'type' => 'multifield',
        'keyData' => 'support-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'support-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'support-sub-title',
            ),
        ),
    ),

);
return $home;
?>