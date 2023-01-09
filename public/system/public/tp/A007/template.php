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
            'startBaMucThongTinDuoiBanner' => array(
                'type' => 'startmodule',
                'label' => '3 Mục thông tin dưới banner'
            ),
            'Tiêu đề mục 1' => array(
                'type' => 'text'
            ),
            'Nội dung mục 1' => array(
                'type' => 'textarea'
            ),
            'Tiêu đề mục 2' => array(
                'type' => 'text'
            ),
            'Nội dung mục 2' => array(
                'type' => 'textarea'
            ),
            'Tiêu đề mục 3' => array(
                'type' => 'text'
            ),
            'Nội dung mục 3' => array(
                'type' => 'textarea'
            ),
            'endBaMucThongTinDuoiBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSliderBaiViet' => array(
                'type' => 'startmodule',
                'label' => 'Slider bài viết'
            ),
            'Tiêu đề slider bài viết' => array(
                'type' => 'text',
            ),
            'Bài viết slider' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'Tiêu đề cột bài viết bên phải' => array(
                'type' => 'text',
            ),
            '3 Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'endSliderBaiViet' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 Cột thông tin'
            ),
            'Tiêu đề 3 cột thông tin' => array(
                'type' => 'text',
            ),
            'Tiêu đề cột thông tin 1' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 3' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 3' => array(
                'type' => 'textarea',
            ),
            'endBaCotThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/


            /**** start *****/
            'startKhachHangPhanHoi' => array(
                'type' => 'startmodule',
                'label' => 'Phản hồi của khách hàng'
            ),
            'Tiêu đề phản hồi của khách hàng' => array(
                'type' => 'text',
            ),
            'Mô tả phản hồi của khách hàng' => array(
                'type' => 'text',
            ),
            'Phản hồi của khách hàng' => array(
                'type' => 'select multi',
                'name' => 'news',
                'limit' => '5',
            ),
            'endKhachHangPhanHoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSliderSanPham' => array(
                'type' => 'startmodule',
                'label' => 'Slider sản phẩm'
            ),
            'Tiêu đề slider sản phẩm' => array(
                'type' => 'text',
            ),
            'Mô tả slider sản phẩm' => array(
                'type' => 'text',
            ),
            'Sản phẩm' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 10,
            ),
            'endSliderSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startThuongHieu' => array(
                'type' => 'startmodule',
                'label' => 'Các thương hiệu'
            ),
            'Thương hiệu' => array(
                'type' => 'text',
            ),
            'endThuongHieu' => array(
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
            'startBaiVietFooter' => array(
                'type' => 'startmodule',
                'label' => 'Bài viết footer'
            ),
            'Tiêu đề cột bài viết' => array(
                'type' => 'text'
            ),
            'Bài viết footer' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 5
            ),
            'endBaiVietFooter' => array(
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
            'Đường dẫn Copyright' => array(
                'type' => 'text',
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
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),
    );

    return $a;
?>