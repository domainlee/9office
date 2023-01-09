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
                'limit' => 10,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start3CotThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 Cột thông tin',
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
            ),
            'Nội dung cột 1' => array(
                'type' => 'textarea',
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
            'end3CotThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start4Banner' => array(
                'type' => 'startmodule',
                'label' => '4 Banner'
            ),
            'Tiêu đề 4 banner' => array(
                'type' => 'text',
                'description' => 'Tiêu đề và 4 Banner trang chủ',
            ),
            '4 Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 4,
            ),
            'end4Banner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBonTabSanPham' => array(
                'type' => 'startmodule',
                'label' => '4 Tab sản phẩm'
            ),
            'Tiêu đề 4 tab sản phẩm' => array(
                'type' => 'text',
            ),
            'Mô tả 4 tab sản phẩm' => array(
                'type' => 'text',
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
            ),
            'Sản phẩm tab 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề tab 2' => array(
                'type' => 'text',
            ),
            'Sản phẩm tab 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề tab 3' => array(
                'type' => 'text',
            ),
            'Sản phẩm tab 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề tab 4' => array(
                'type' => 'text',
            ),
            'Sản phẩm tab 4' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endBonTabSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startSanPhamTieuBieu' => array(
                'type' => 'startmodule',
                'label' => 'Sản phẩm tiêu biểu'
            ),
            'Tiêu đề sản phẩm tiêu biểu' => array(
                'type' => 'text',
                'description' => 'Slider sản phẩm tiêu biểu (Tiêu đề, sản phẩm)',
            ),
            'Sản phẩm tiêu biểu' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 5,
            ),
            'endSanPhamTieuBieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức'
            ),
            'Tiêu đề tin tức' => array(
                'type' => 'text',
                'description' => 'Tiêu đề, lựa chọn bài viết (2 bài viết)',
            ),
            'Mô tả tin tức' => array(
                'type' => 'text',
                'description' => 'Tiêu đề, lựa chọn bài viết (2 bài viết)',
            ),
            '2 Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 2,
            ),
            'endTinTuc' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

        ),
        'Footer' => array(
            /**** start *****/
            'startCotGioiThieu' => array(
                'type' => 'startmodule',
                'label' => 'Cột giới thiệu'
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
            'startDanhSachLienKet' => array(
                'type' => 'startmodule',
                'label' => 'Danh sách liên kết'
            ),
            'Tiêu đề danh sách liên kết' => array(
                'type' => 'text',
                'description' => 'Tạo các liên kết tại phần danh mục footer'
            ),
            'endDanhSachLienKet' => array(
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

            'Google' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
            ),
            'Twitter' => array(
                'type' => 'text',
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
            'Đường dẫn Copyright' => array(
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