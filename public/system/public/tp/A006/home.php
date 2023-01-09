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
    'Tin tức kiểu 1' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout-1',
        'field' => array (
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'news-slider-checkbox-1',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 7,
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
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'news-2-title',
            ),
            'Bài viết bên trái' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 7,
                'keyData' => 'news-list-2',
            ),
            'Tiêu đề cột tin tức bên phải' => array(
                'type' => 'text',
                'keyData' => 'right-news-title',
            ),
            'Cột tin tức bên phải' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'keyData' => 'right-news-list',
                'limit' => 4,
            )

        ),
    ),
    '3 Cột thông tin' => array(
        'label' => '3 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'three-option-layout',
        'field' => array(
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
                'keyData' => 'option-link-1'
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
                'keyData' => 'option-link-2'
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
                'keyData' => 'option-link-3'
            ),
        ),
    ),
    'Galery' => array(
        'label' => 'Galery ảnh',
        'type' => 'multifield',
        'keyData' => 'galery-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'galery-title',
            ),
            'Hình ảnh' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 10,
                'keyData' => 'galery-list',
            )
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
    'Câu hỏi thường gặp & Form đăng ký' => array(
        'type' => 'multifield',
        'keyData' => 'question-form-layout',
        'field' => array(
            'Tiêu đề câu hỏi thường gặp' => array(
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
            'Tiêu đề form đăng ký' => array(
                'type' => 'text',
                'keyData' => 'form-register',
            ),
        ),
    ),

);
return $home;
?>