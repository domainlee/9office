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
            'Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
                'keyData' => 'small-banner-list',
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
            'Danh mục liên quan' => array(
                'type' => 'selectmulti',
                'name' => 'productcategory',
                'limit' => 8,
                'keyData' => 'product-category',
            ),
        ),
    ),
    '7 sản phẩm' => array (
        'label' => '7 sản phẩm',
        'type' => 'multifield',
        'keyData' => 'seven-product-list',
        'field' => array (
            'Tiêu đề' => array (
                'type' => 'text',
                'keyData' => 'product-title',
            ),
            'Sản phẩm nổi bật' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 1,
                'keyData' => 'feature-product'
            ),
            '6 Sản phẩm' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
                'keyData' => 'product-list',
            ),
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
                'limit' => 5,
                'keyData' => 'tab-product1',
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'keyData' => 'tab2-title',
            ),
            'Sản phẩm tab 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 5,
                'keyData' => 'tab-product2',
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'keyData' => 'tab3-title',
            ),
            'Sản phẩm tab 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 5,
                'keyData' => 'tab-product3',
            ),
        ),
    ),
    'Cột Sản phẩm' => array (
        'label' => 'Cột sản phẩm',
        'type' => 'multifield',
        'keyData' => 'column-product-layout',
        'field' => array (
            'Tiêu đề cột 1' => array(
                'type' => 'text',
                'keyData' => 'col1-title',
            ),
            'Sản phẩm cột 1' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'col-product1',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
                'keyData' => 'col2-title',
            ),
            'Sản phẩm cột 2' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'col-product2',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
                'keyData' => 'col3-title',
            ),
            'Sản phẩm cột 3' => array (
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
                'keyData' => 'col-product3',
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