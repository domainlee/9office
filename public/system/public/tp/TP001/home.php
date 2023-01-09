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
    '3 cột thông tin' => array(
        'label' => 'Cột thông tin',
        'type' => 'multifield',
        'keyData' => 'info-layout',
        'field' => array(
            'Hình ảnh cột 1' => array(
                'type' => 'file',
                'keyData' => 'info-image-1',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-title-1',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-content-1',
            ),
            'Đường dẫn cột 1' => array(
                'type' => 'text',
                'keyData' => 'info-link-1'
            ),
            'Hình ảnh cột 2' => array(
                'type' => 'file',
                'keyData' => 'info-image-2',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-title-2',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-content-2',
            ),
            'Đường dẫn cột 2' => array(
                'type' => 'text',
                'keyData' => 'info-link-2'
            ),
            'Hình ảnh cột 3' => array(
                'type' => 'file',
                'keyData' => 'info-image-3',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-title-3',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-content-3',
            ),
            'Đường dẫn cột 3' => array(
                'type' => 'text',
                'keyData' => 'info-link-3'
            ),
        ),
    ),
    '4 Banner'=> array(
        'label' => '4 Banner',
        'type' => 'multifield',
        'keyData' => 'four-banner-layout',
        'field' => array(
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'four-banner-title',
            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 4,
                'keyData' => 'four-banner-list',
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
            'Tiêu đề tab 4' => array(
                'type' => 'text',
                'keyData' => 'tab4-title',
            ),
            'Sản phẩm tab 4' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 12,
                'keyData' => 'tab-product4',
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
    'Slider 1 sản phẩm' => array (
        'label' => 'Slider 1 sản phẩm',
        'type' => 'multifield',
        'keyData' => 'slider-product-layout',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'slider-product-title',
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
                'keyData' => 'slider-product-list',
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
            'Slider' => array (
                'type' => 'checkbox',
                'keyData' => 'news-slider-checkbox',
            ),
            'Tiêu đề' => array(
                'type' => 'text',
                'keyData' => 'news-title',
            ),
            'Tin tức' => array (
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 12,
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
            'Hình nền' => array(
                'type' => 'file',
                'keyData' => 'option-background',
            )
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