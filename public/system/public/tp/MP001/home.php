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
            'Mô tả' => array(
                'type' => 'text',
                'keyData' => 'tab-product-sub-title',
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
    'Slider sản phẩm' => array (
        'label' => 'Slider 1 sản phẩm',
        'type' => 'multifield',
        'keyData' => 'slider-product-layout',
        'field' => array (
            'Tiêu đề slider 1' => array(
                'type' => 'text',
                'keyData' => 'slider-1-title',
            ),
            'Mô tả slider 1' => array(
                'type' => 'text',
                'keyData' => 'slider-1-sub-title',
            ),
            'Sản phẩm silder 1' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
                'keyData' => 'slider-1-product-list',
            ),
            'Tiêu đề slider 2' => array(
                'type' => 'text',
                'keyData' => 'slider-2-title',
            ),
            'Mô tả slider 2' => array(
                'type' => 'text',
                'keyData' => 'slider-2-sub-title',
            ),
            'Sản phẩm silder 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
                'keyData' => 'slider-2-product-list',
            ),
            'Tiêu đề slider 3' => array(
                'type' => 'text',
                'keyData' => 'slider-3-title',
            ),
            'Mô tả slider 3' => array(
                'type' => 'text',
                'keyData' => 'slider-3-sub-title',
            ),
            'Sản phẩm silder 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
                'keyData' => 'slider-3-product-list',
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
            'Tiêu đề' => array(
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
                'limit' => 12,
                'keyData' => 'news-list',
            ),

        ),
    ),
    'Phản hồi của khách hàng' => array(
        'label' => 'Phản hồi của khách hàng',
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
            'Ảnh đại diện khách hàng 1' => array(
                'type' => 'file',
                'keyData' => 'avatar-1',
            ),
            'Tên khách hàng 1' => array(
                'type' => 'text',
                'keyData' => 'name-1',
            ),
            'Nội dung phản hồi của khách hàng 1' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-1',
            ),
            'Ảnh đại diện khách hàng 2' => array(
                'type' => 'file',
                'keyData' => 'avatar-2',
            ),
            'Tên khách hàng 2' => array(
                'type' => 'text',
                'keyData' => 'name-2',
            ),
            'Nội dung phản hồi của khách hàng 2' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-2',
            ),
            'Ảnh đại diện khách hàng 3' => array(
                'type' => 'file',
                'keyData' => 'avatar-3',
            ),
            'Tên khách hàng 3' => array(
                'type' => 'text',
                'keyData' => 'name-3',
            ),
            'Nội dung phản hồi của khách hàng 3' => array(
                'type' => 'textarea',
                'keyData' => 'feedback-3',
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