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
            'Tiêu đề cột câu hỏi thường gặp' => array(
                'type' => 'text',
                'keyData' => 'question-title',
            ),
            'Câu hỏi 1' => array(
                'type' => 'text',
                'keyData' => 'question-1',
            ),
            'Câu trả lời 1' => array(
                'type' => 'text',
                'keyData' => 'answer-1',
            ),
            'Câu hỏi 2' => array(
                'type' => 'text',
                'keyData' => 'question-2',
            ),
            'Câu trả lời 2' => array(
                'type' => 'text',
                'keyData' => 'answer-2',
            ),
            'Câu hỏi 3' => array(
                'type' => 'text',
                'keyData' => 'question-3',
            ),
            'Câu trả lời 3' => array(
                'type' => 'text',
                'keyData' => 'answer-3',
            ),
            'Câu hỏi 4' => array(
                'type' => 'text',
                'keyData' => 'question-4',
            ),
            'Câu trả lời 4' => array(
                'type' => 'text',
                'keyData' => 'answer-4',
            ),
            'Câu hỏi 5' => array(
                'type' => 'text',
                'keyData' => 'question-5',
            ),
            'Câu trả lời 5' => array(
                'type' => 'text',
                'keyData' => 'answer-5',
            ),
        ),
    ),
    'Tin tức kiểu 1' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout-1',
        'field' => array (
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 12,
                'keyData' => 'news-list-1',
            ),

        ),
    ),
    'Tin tức kiểu 2' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout-2',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'news-slider-checkbox-2',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 12,
                'keyData' => 'news-list-2',
            ),

        ),
    ),
    'Cột thông tin' => array(
        'label' => 'Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'info-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'info-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'info-sub-title',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-title-1',
            ),
            'Nội dung cột 1' => array(
                'type' => 'textarea',
                'keyData' => 'info-content-1',
            ),
            'Đường dẫn cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-link-1'
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-title-2',
            ),
            'Nội dung cột 2' => array(
                'type' => 'textarea',
                'keyData' => 'info-content-2',
            ),
            'Đường dẫn cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-link-2'
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-title-3',
            ),
            'Nội dung cột 3' => array(
                'type' => 'textarea',
                'keyData' => 'info-content-3',
            ),
            'Đường dẫn cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-link-3'
            ),
        ),
    ),
    'Galery' => array(
        'label' => 'Galery ảnh',
        'type' => 'multifield',
        'keyData' => 'galery-layout',
        'field' => array(
            'slider' => array(
                'type' => 'checkbox',
                'keyData' => 'galery-slider-checkbox checkbox',
            ),
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'galery-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'galery-sub-title',
            ),
            'Hình ảnh' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 10,
                'keyData' => 'galery-list',
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