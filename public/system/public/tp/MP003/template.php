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
        'Header' => array(
            'Hotline' => array(
                'type' => 'text',
            ),
            'Email' => array(
                'type' => 'text',
            ),
            'Địa chỉ shop' => array(
                'type' => 'text',
            ),
        ),
        'Footer' => array(

            /**** start *****/
            'startCotGioiThieu' => array(
                'type' => 'startmodule',
                'label' => 'Giới thiệu'
            ),
            'Tiêu đề giới thiệu' => array(
                'type' => 'text',
            ),
            'Nội dung giới thiệu' => array(
                'type' => 'textarea',
            ),

            'endGioiThieu' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startDanhSachLienKet1' => array(
                'type' => 'startmodule',
                'label' => 'Danh sách liên kết 1'
            ),
            'Tiêu đề danh sách liên kết 1' => array(
                'type' => 'text',
                'description' => 'Tạo các liên kết tại phần danh mục footer 1'
            ),
            'endDanhSachLienKet1' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startDanhSachLienKet2' => array(
                'type' => 'startmodule',
                'label' => 'Danh sách liên kết 2'
            ),
            'Tiêu đề danh sách liên kết 2' => array(
                'type' => 'text',
                'description' => 'Tạo các liên kết tại phần danh mục footer 2'
            ),
            'endDanhSachLienKet2' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/


            /**** start *****/
            'startThongTinDiaChi' => array(
                'type' => 'startmodule',
                'label' => 'Thông tin địa chỉ'
            ),
            'Tiêu đề thông tin' => array(
                'type' => 'text',
            ),
            'Địa chỉ' => array(
                'type' => 'textarea',
            ),
            'endThongTinDiaChi' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startCopyRight' => array(
                'type' => 'startmodule',
                'label' => 'Copyright',
            ),
            'Copyright' => array(
                'type' => 'text',
            ),
            'Google' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
            ),
            'Instagram' => array(
                'type' => 'text',
            ),
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),
    );
    return $a;
?>