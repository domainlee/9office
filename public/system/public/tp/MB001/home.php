<?php
$home = array(
    'Banner' => array (
        'label' => 'Banner',
        'type' => 'multifield',
        'keyData' => 'banner-layout',
        'field' => array(
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
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
            'Đường dẫn ảnh' => array(
                'type' => 'text',
                'keyData' => 'intro-link',
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
            'Slider' => array(
                'type' => 'checkbox',
                'keyData' => 'tab-product-slider-checkbox',
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
                'keyData' => 'tab1-title',
            ),
            'Sản phẩm tab 1' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 12,
                'keyData' => 'tab-product1',
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'keyData' => 'tab2-title',
            ),
            'Sản phẩm tab 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 12,
                'keyData' => 'tab-product2',
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'keyData' => 'tab3-title',
            ),
            'Sản phẩm tab 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 12,
                'keyData' => 'tab-product3',
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
    '4 Cột thông tin' => array(
        'label' => '4 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'four-option-layout',
        'field' => array(
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
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'option-background',
            ),
            'Tiêu đề' => array(
               'type' => 'text',
                'keyData' => 'option-title',
            ),
            'Nội dung' => array(
                'type' => 'texteditor',
                'keyData' => 'option-content',
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