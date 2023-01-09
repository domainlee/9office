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
            'Tiêu đề mục thông tin 1' => array(
                'type' => 'text',
                'keyData' => 'info-title-1',
            ),
            'Nội dung mục thông tin 1' => array(
                'type' => 'text',
                'keyData' => 'info-content-1',
            ),
            'Tiêu đề mục thông tin 2' => array(
                'type' => 'text',
                'keyData' => 'info-title-2',
            ),
            'Nội dung mục thông tin 2' => array(
                'type' => 'text',
                'keyData' => 'info-content-2',
            ),
            'Tiêu đề mục thông tin 3' => array(
                'type' => 'text',
                'keyData' => 'info-title-3',
            ),
            'Nội dung mục thông tin 3' => array(
                'type' => 'text',
                'keyData' => 'info-content-3',
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
            'Tiêu đề cột bài viết bên phải' => array(
                'type' => 'text',
                'keyData' => 'news-right-title'
            ),
            'Bài viết bên phải' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 5,
                'keyData' => 'news-right',
            ),

        ),
    ),
    '3 Cột thông tin' => array(
        'label' => '3 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'three-option-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'three-option-title',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-title-1',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-content-1',
            ),
            'Nội dung cột 1 dạng danh sách' => array(
                'type' => 'textarea',
                'keyData' => 'option-list-content-1',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-title-2',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-content-2',
            ),
            'Nội dung cột 2 dạng danh sách' => array(
                'type' => 'textarea',
                'keyData' => 'option-list-content-2',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-title-3',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-content-3',
            ),
            'Nội dung cột 3 dạng danh sách' => array(
                'type' => 'textarea',
                'keyData' => 'option-list-content-3',
            ),
        ),
    ),
    'Cảm nhận của học viên' => array(
        'label' => 'Cảm nhận của học viên',
        'type' => 'multifield',
        'keyData' => 'feedback-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'feedback-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'feedback-sub-title',
            ),
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'feedback-background',
            ),
            'Ảnh đại diện học viên 1' => array(
                'type' => 'file',
                'keyData' => 'avatar-1',
            ),
            'Tên học viên 1' => array(
                'type' => 'text',
                'keyData' => 'name-1',
            ),
            'Nội dung phản hồi của học viên 1' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-1',
            ),
            'Ảnh đại diện học viên 2' => array(
                'type' => 'file',
                'keyData' => 'avatar-2',
            ),
            'Tên học viên 2' => array(
                'type' => 'text',
                'keyData' => 'name-2',
            ),
            'Nội dung phản hồi của học viên 2' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-2',
            ),
            'Ảnh đại diện học viên 3' => array(
                'type' => 'file',
                'keyData' => 'avatar-3',
            ),
            'Tên học viên 3' => array(
                'type' => 'text',
                'keyData' => 'name-3',
            ),
            'Nội dung phản hồi của học viên 3' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-3',
            ),
            'Ảnh đại diện học viên 4' => array(
                'type' => 'file',
                'keyData' => 'avatar-4',
            ),
            'Tên học viên 4' => array(
                'type' => 'text',
                'keyData' => 'name-4',
            ),
            'Nội dung phản hồi của học viên 4' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-4',
            ),
        ),
    ),
    'Slider ảnh' => array(
        'label' => 'Slider ảnh',
        'type' => 'multifield',
        'keyData' => 'galery-layout',
        'field' => array(
            'Ảnh 1' => array(
                'type' => 'file',
                'keyData' => 'image-1',
            ),
            'Đường dẫn ảnh 1' => array(
                'type' => 'text',
                'keyData' => 'image-link-1'
            ),
            'Ảnh 2' => array(
                'type' => 'file',
                'keyData' => 'image-2',
            ),
            'Đường dẫn ảnh 2' => array(
                'type' => 'text',
                'keyData' => 'image-link-2'
            ),
            'Ảnh 3' => array(
                'type' => 'file',
                'keyData' => 'image-3',
            ),
            'Đường dẫn ảnh 3' => array(
                'type' => 'text',
                'keyData' => 'image-link-3'
            ),
            'Ảnh 4' => array(
                'type' => 'file',
                'keyData' => 'image-4',
            ),
            'Đường dẫn ảnh 4' => array(
                'type' => 'text',
                'keyData' => 'image-link-4'
            ),
            'Ảnh 5' => array(
                'type' => 'file',
                'keyData' => 'image-5',
            ),
            'Đường dẫn ảnh 5' => array(
                'type' => 'text',
                'keyData' => 'image-link-5'
            ),
            'Ảnh 6' => array(
                'type' => 'file',
                'keyData' => 'image-6',
            ),
            'Đường dẫn ảnh 6' => array(
                'type' => 'text',
                'keyData' => 'image-link-6'
            ),
            'Ảnh 7' => array(
                'type' => 'file',
                'keyData' => 'image-7',
            ),
            'Đường dẫn ảnh 7' => array(
                'type' => 'text',
                'keyData' => 'image-link-7'
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