<?php
$a = array(
    'Sidebar tin tức' => array(
        /**** start *****/
        'startDanhMuc1' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sidebar 1'
        ),
        'Tiêu đề danh mục tin tức 1' => array(
            'type' => 'text',
        ),
        'Bài viết danh mục 1' => array(
            'type' => 'selectmulti',
            'name' => 'news',
            'limit' => 10,
        ),
        'endDanhMuc1' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startDanhMuc2' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sidebar 2'
        ),
        'Tiêu đề danh mục tin tức 2' => array(
            'type' => 'text',
        ),
        'Bài viết danh mục 2' => array(
            'type' => 'selectmulti',
            'name' => 'news',
            'limit' => 10,
        ),
        'endDanhMuc2' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startBannerSidebar' => array(
            'type' => 'startmodule',
            'label' => 'Banner sidebar'
        ),
        'Banner sidebar' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 1,
        ),
        'endBannerSidebar' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/
    ),
    'Siderbar sản phẩm' => array(
        /**** start *****/
        'startDanhMucSanPham1' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 1'
        ),
        'Tiêu đề danh muc sản phẩm 1' => array(
            'type' => 'text',
        ),
        'Sản phẩm thuộc danh mục 1' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 5,
        ),
        'endDanhMucSanPham1' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startDanhMucSanPham2' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 2'
        ),
        'Tiêu đề danh muc sản phẩm 2' => array(
            'type' => 'text',
        ),
        'Sản phẩm thuộc danh mục 2' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 5,
        ),
        'endDanhMucSanPham2' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/
    ),
    'Footer' => array(
        'startFooter1' => array(
            'type' => 'startmodule',
            'label' => 'Footer 1'
        ),
        'Nội dung footer' => array(
            'type' => 'textarea',
        ),
        'endFooter1' => array(
            'type' => 'endmodule',
        ),
    ),
    'Social' => array(
        'Facebook' => array(
            'type' => 'text',
        ),
        'Google' => array(
            'type' => 'text',
        ),
        'Twitter' => array(
            'type' => 'text',
        ),
        'Skype' => array(
            'type' => 'text',
        ),
    ),

);

return $a;
?>