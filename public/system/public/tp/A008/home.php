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
            'Nội dung dạng danh sách' => array(
                'type' => 'textarea',
                'keyData' => 'intro-list-content',
            ),
            'Video' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.',
                'keyData' => 'video-url',
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
    '4 Cột thông tin' => array(
        'label' => '4 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'four-option-layout',
        'field' => array(
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'four-option-background',
            ),
            'Hình ảnh cột 1' => array(
                'type' => 'file',
                'keyData' => 'option-1-image',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-1-title',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-1-content',
            ),
            'Hình ảnh cột 2' => array(
                'type' => 'file',
                'keyData' => 'option-2-image',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-2-title',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-2-content',
            ),
            'Hình ảnh cột 3' => array(
                'type' => 'file',
                'keyData' => 'option-3-image',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-3-title',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-3-content',
            ),
            'Hình ảnh cột 4' => array(
                'type' => 'file',
                'keyData' => 'option-4-image',
            ),
            'Tiêu đề cột 4' => array(
                'type' => 'text',
                'keyData' => 'option-4-title',
            ),
            'Nội dung cột 4' => array(
                'type' => 'text',
                'keyData' => 'option-4-content',
            ),

        ),
    ),
    '3 Cột thông tin' => array(
        'label' => '3 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'three-option-layout',
        'field' => array(
            'Hình ảnh cột 1' => array(
                'type' => 'file',
                'keyData' => 'option-image-1',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-title-1',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-content-1',
            ),
            'Đường dẫn cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-link-1',
            ),
            'Hình ảnh cột 2' => array(
                'type' => 'file',
                'keyData' => 'option-image-2',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-title-2',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-content-2',
            ),
            'Đường dẫn cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-link-2',
            ),
            'Hình ảnh cột 3' => array(
                'type' => 'file',
                'keyData' => 'option-image-3',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-title-3',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-content-3',
            ),
            'Đường dẫn cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-link-3',
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