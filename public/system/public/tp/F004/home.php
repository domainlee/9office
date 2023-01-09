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
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'keyData' => 'small-banner-list',
            ),
        ),
    ),

  /*  'Banner tùy chỉnh' => array (
        'label' => 'Banner nhỏ',
        'type' => 'multifield',
        'keyData' => 'banner-with-field',
        'field' => array(
            'Hiển thị tiêu dề' => array(
                'type' => 'checkbox',
                'keyData' => 'banner-title-checkbox',
            ),
            'Banner tùy chỉnh' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'keyData' => 'banner-option-list',
            ),
        ),
    ),*/
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
                'limit' => 8,
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
    'Tab Sản phẩm' => array (
        'label' => 'Tab sản phẩm',
        'type' => 'multifield',
        'keyData' => 'tab-product-layout',
        'field' => array (
            'Tiêu đề tab 1' => array(
                'type' => 'text',
                'keyData' => 'tab1-title',
            ),
            'Sản phẩm tab 1' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product1',
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'keyData' => 'tab2-title',
            ),
            'Sản phẩm tab 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product2',
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'keyData' => 'tab3-title',
            ),
            'Sản phẩm tab 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'tab-product3',
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

);
return $home;
?>