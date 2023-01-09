<?php
$a = array(
    'Trang chủ' => array(
//            'Danh mục sản phẩm' => array(
//                'type' => 'selectmulti',
//                'name' => 'categoryproduct',
//                'limit' => 8,
//            ),
        /**** start *****/
        'startBanner' => array(
            'type' => 'startmodule',
            'label' => 'Banner'
        ),
        'Banner' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 8,
        ),
        'endBanner' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startBaBannerNho' => array(
            'type' => 'startmodule',
            'label' => '3 Banner nhỏ'
        ),
        '3 Banner nhỏ' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 3,
        ),
        'endBaBannerNho' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

//            'Page' => array(
//                'type' => 'selectmulti',
//                'name' => 'page',
//                'limit' => 8,
//            ),
        /**** start *****/
        'startDanhMuc1' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục 1'
        ),
        'Tiêu đề danh mục 1' => array(
            'type' => 'text',
            'value' => '',
        ),
        'San phẩm danh mục 1' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 8,
        ),
        'endDanhMuc1' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startDanhMuc2' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục 2'
        ),
        'Tiêu đề danh mục 2' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm danh mục 2' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 8,
        ),
        'endDanhMuc2' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startDanhMuc3' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục 3'
        ),
        'Tiêu đề danh mục 3' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm danh mục 3' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 8,
        ),
        'endDanhMuc3' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startTinTuc' => array(
            'type' => 'startmodule',
            'label' => 'Tin tức'
        ),
        'Tiêu đề Tin tức' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Tin tức' => array(
            'type' => 'selectmulti',
            'name' => 'news',
            'limit' => 3,
        ),
        'endTinTuc' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

    ),
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
   /* 'Header' => array(
        'option1' => array(
            'type' => 'text',
            'value' => '',
        ),
        'option2' => array(
            'type' => 'text',
            'value' => '',
        ),
    ),*/
    'Footer' => array(

        /**** start *****/
        'startFooter1' => array(
            'type' => 'startmodule',
            'label' => 'Footer 1'
        ),
        'Tiêu đề cột mạng xã hội' => array(
            'type' => 'text',
        ),
        'Facebook' => array(
            'type' => 'text',
        ),
        'Instagram' => array(
            'type' => 'text',
        ),
        'Youtube' => array(
            'type' => 'text',
        ),
        'Tiêu đề cột 2' => array(
            'type' => 'text',
        ),
        'Nội dung cột 2' => array(
            'type' => 'textarea',
        ),
        'Tiêu đề cột 3' => array(
            'type' => 'text',
        ),
        'Nội dung cột 3' => array(
            'type' => 'textarea',
        ),
        'endFooter1' => array(
            'type' => 'endmodule',
        ),

        /**** end ****/

        /**** start *****/
        'startFooter2' => array(
            'type' => 'startmodule',
            'label' => 'Footer 2'
        ),
        'Tiêu đề cột 1' => array(
            'type' => 'text',
        ),
        'Nội dung cột 1' => array(
            'type' => 'textarea',
        ),
        'Tiêu đề cột danh mục' => array(
            'type' => 'text',
        ),
        'Tiêu đề cột thông tin 3' => array(
            'type' => 'text',
        ),
        'Nội dung cột thông tin 3' => array(
            'type' => 'textarea',
        ),
        'endFooter2' => array(
            'type' => 'endmodule',
        ),

        /**** end ****/
    ),
);

return $a;
?>