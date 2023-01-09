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
    '3 Banner'=> array(
        'label' => '4 Banner',
        'type' => 'multifield',
        'keyData' => 'three-banner-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'three-banner-title',
            ),
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'three-banner-sub-title',
            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'keyData' => 'three-banner-list',
            ),
        ),
    ),
    'Tab Sản phẩm' => array (
        'label' => 'Tab sản phẩm',
        'type' => 'multifield',
        'keyData' => 'tab-product-layout',
        'field' => array (
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
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'product-sub-title',
            ),

//                'Ảnh 2' => array (
//                    'type' => 'file',
//                    'keyData' => 'product-image-2',
//                ),
//                'Mô tả đơn giản' => array (
//                    'type' => 'textarea',
//                    'keyData' => 'product-intro',
//                ),
//                'Mô tả' => array (
//                    'type' => 'texteditor',
//                    'keyData' => 'product-description',
//                ),

//                'Trang' => array (
//                    'type' => 'selectmulti',
//                    'name' => 'page',
//                    'limit' => 8,
//                    'keyData' => 'page-list',
//                ),
            'Sản phẩm' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 12,
                'keyData' => 'product-list',
            ),
//                'Danh mục sản phẩm' => array (
//                    'type' => 'selectmulti',
//                    'name' => 'productcategory',
//                    'limit' => 8,
//                    'keyData' => 'product-category',
//                ),
//                'Tin tức' => array (
//                    'type' => 'selectmulti',
//                    'name' => 'news',
//                    'limit' => 8,
//                    'keyData' => 'news-list',
//                ),
//                'Danh mục Tin tức' => array (
//                    'type' => 'selectmulti',
//                    'name' => 'newscategory',
//                    'limit' => 8,
//                    'keyData' => 'news-description',
//                ),

        ),
    ),
    'Tin tức' => array (
        'label' => 'Tin tức',
        'type' => 'multifield',
        'keyData' => 'news-layout',
        'field' => array (
            'Hình ảnh' => array(
                'type' => 'file',
                'keyData' => 'news-image',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 12,
                'keyData' => 'news-list',
            ),

        ),
    ),
    'Tin tức nổi bật' => array (
        'label' => 'Tin tức nổi bật',
        'type' => 'multifield',
        'keyData' => 'highlight-news-layout',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'highlight-news-title',
            ),
            'Mô tả' => array(
                'type' => 'textarea',
                'keyData' => 'highlight-news-intro',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 1,
                'keyData' => 'highlight-news-list',
            ),
            'Button' => array(
                'type' => 'text',
                'keyData' => 'highlight-news-button',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
                'keyData' => 'news-button-links',
            ),
        ),
    ),
    '3 Cột thông tin' => array(
        'label' => '4 Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'three-option-layout',
        'field' => array(
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-1-title',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'option-1-content',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-2-title',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'option-2-content',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-3-title',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'option-3-content',
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

);
return $home;
?>