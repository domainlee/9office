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
            'Hình ảnh 1' => array(
                'type' => 'file',
                'keyData' => 'intro-image-1',
            ),
            'Đường dẫn hình ảnh 1' => array(
                'type' => 'text',
                'keyData' => 'intro-image-link-1'
            ),
            'Hình ảnh 2' => array(
                'type' => 'file',
                'keyData' => 'intro-image-2',
            ),
            'Đường dẫn hình ảnh 2' => array(
                'type' => 'text',
                'keyData' => 'intro-image-link-2'
            ),
            'Hình ảnh 3' => array(
                'type' => 'file',
                'keyData' => 'intro-image-3',
            ),
            'Đường dẫn hình ảnh 3' => array(
                'type' => 'text',
                'keyData' => 'intro-image-link-3'
            ),
            'Nội dung' => array(
                'type' => 'textarea',
                'keyData' => 'intro-content',
            ),
        ),
    ),
    'Tiện ích dự án' => array(
        'label' => 'Tiện ích dự án',
        'type' => 'multifield',
        'keyData' => 'project-layout',
        'field' => array(
            'Slider' => array(
                'type' => 'checkbox',
                'keyData' => 'project-slider-checkbox',
            ),
            'Tiêu đề nhỏ' => array(
                'type' => 'text',
                'keyData' => 'project-small-title',
            ),
            'Tiêu đề lớn' => array(
                'type' => 'text',
                'keyData' => 'project-big-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'project-sub-title',
            ),
            'Dự án' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'keyData' => 'project-list',
                'limit' => 12,
            ),
            'Button' => array(
                'type' => 'text',
                'keyData' => 'project-button',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'project-link',
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
            'Tiêu đề nhỏ' => array(
                'type' => 'text',
                'keyData' => 'news-small-title',
            ),
            'Tiêu đề lớn' => array(
                'type' => 'text',
                'keyData' => 'news-big-title',
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
            'Button' => array(
                'type' => 'text',
                'keyData' => 'news-button',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'news-link',
            ),
        ),
    ),
    'Phản hồi của khách hàng' => array(
        'label' => 'Phản hồi của khách hàng',
        'type' => 'multifield',
        'keyData' => 'feedback-layout',
        'field' => array(
            'Tiêu đề nhỏ' => array(
                'type' => 'text',
                'keyData' => 'feedback-small-title',
            ),
            'Tiêu đề lớn' => array(
                'type' => 'text',
                'keyData' => 'feedback-big-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'feedback-sub-title',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'feedback-background',
            ),
            'Tên khách hàng 1' => array(
                'type' => 'text',
                'keyData' => 'name-1',
            ),
            'Nội dung phản hồi của khách hàng 1' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-1',
            ),
            'Tên khách hàng 2' => array(
                'type' => 'text',
                'keyData' => 'name-2',
            ),
            'Nội dung phản hồi của khách hàng 2' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-2',
            ),
            'Tên khách hàng 3' => array(
                'type' => 'text',
                'keyData' => 'name-3',
            ),
            'Nội dung phản hồi của khách hàng 3' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-3',
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
    'Tab hình ảnh dự án và mô tả' => array(
        'label' => 'Phản hồi của khách hàng',
        'type' => 'multifield',
        'keyData' => 'tab-project-layout',
        'field' => array(
            'Tiêu đề nhỏ' => array(
                'type' => 'text',
                'keyData' => 'tab-small-title',
            ),
            'Tiêu đề lớn' => array(
                'type' => 'text',
                'keyData' => 'tab-big-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'tab-sub-title',
            ),
            'Hình ảnh 1' => array(
                'type' => 'file',
                'keyData' => 'tab-image-1',
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
                'keyData' => 'tab-title-1',
            ),
            'Mô tả tab 1' => array(
                'type' => 'textarea',
                'keyData' => 'tab-description-1',
            ),
            'Hình ảnh 2' => array(
                'type' => 'file',
                'keyData' => 'tab-image-2',
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'keyData' => 'tab-title-2',
            ),
            'Mô tả 2' => array(
                'type' => 'textarea',
                'keyData' => 'tab-description-2',
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'keyData' => 'tab-title-3',
            ),
            'Hình ảnh 3' => array(
                'type' => 'file',
                'keyData' => 'tab-image-1',
            ),
            'Mô tả 3' => array(
                'type' => 'textarea',
                'keyData' => 'tab-description-3',
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
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'option-background',
            ),
            'Button' => array(
                'type' => 'text',
                'keyData' => 'option-button',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'option-link',
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