<?php
    $a = array(
        'Trang chủ' => array(

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
            '2 Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 2,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBonTabSanPham' => array(
                'type' => 'startmodule',
                'label' => '4 Tab sản phẩm'
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
                'value' => '',
            ),
            'Sản phẩm tab 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
                'value' => '',
            ),
            'Sản phẩm tab 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
                'value' => '',
            ),
            'Sản phẩm tab 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
            ),
            'Tiêu đề tab 4' => array(
                'type' => 'text',
                'value' => '',
            ),
            'Sản phẩm tab 4' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 6,
            ),
            'endBonTabSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start2Banner' => array(
                'type' => 'startmodule',
                'label' => '2 Banner giữa'
            ),
            '2 Banner giữa' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 2,
            ),
            'end2Banner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDanhMucSanPham' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục sản phẩm'
            ),
            'Danh mục sản phẩm' => array(
                'type' => 'selectmulti',
                'name' => 'categoryproduct',
                'limit' => 1,
                'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
            ),
            'endDanhMucSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start1Banner' => array(
                'type' => 'startmodule',
                'label' => '1 Banner giữa'
            ),
            '1 Banner giữa' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'end1Banner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start3CotSanPham' => array(
                'type' => 'startmodule',
                'label' => '3 Cột sản phẩm'
            ),
            'Tiêu đề cột sản phẩm 1' => array(
                'type' => 'text',
            ),
            'Sản phẩm cột 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 3,
            ),
            'Tiêu đề cột sản phẩm 2' => array(
                'type' => 'text',
            ),
            'Sản phẩm cột 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 3,
            ),
            'Tiêu đề cột sản phẩm 3' => array(
                'type' => 'text',
            ),
            'Sản phẩm cột 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 3,
            ),
            'end3CotSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

        ),
        'Sidebar' => array(
            /**** start *****/
            'startDanhMuc1' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục sidebar 1'
            ),
            'Tiêu đề danh muc 1' => array(
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
            'Tiêu đề danh muc 2' => array(
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
        'Header' => array(
            'Số điện thoại tư vấn' => array(
                'type' => 'text',
            ),
            'Từ khoá tìm kiếm' => array(
                'type' => 'text',
                'description' => 'Từ khoá dưới thanh search, các từ cách nhau (,). Ví dụ: iPhone, Sơ mi, Jean',
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
            'Google' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
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
                'description' => 'Tạo các liên kết tại Website > Menu > Danh mục footer 1'
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
                'description' => 'Tạo các liên kết tại Website > Menu > Danh mục footer 2'
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
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),

    );

    return $a;
?>