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
                'limit' => 5,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startGioithieu' => array(
                'type' => 'startmodule',
                'label' => 'Giới thiệu'
            ),
            'Tiêu đề giới thiệu' => array(
                'type' => 'text',
            ),
            'Nội dung giới thiệu' => array(
                'type' => 'textarea',
            ),
            'Nội dung liệt kê dòng 1' => array(
                'type' => 'text'
            ),
            'Nội dung liệt kê dòng 2' => array(
                'type' => 'text'
            ),
            'Nội dung liệt kê dòng 3' => array(
                'type' => 'text'
            ),
            'Nội dung liệt kê dòng 4' => array(
                'type' => 'text'
            ),
            'Nội dung liệt kê dòng 5' => array(
                'type' => 'text'
            ),
            'Video bên phải' => array(
                'type' => 'text',
                'description' => 'Ví dụ https://www.youtube.com/watch?v=HsMFcQlxwKs. Sao chép HsMFcQlxwKs. Paste vào ô.'
            ),
            'endGioithieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 Cột thông tin'
            ),
            'Tiêu đề cột thông tin 1' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Đường dẫn cột thông tin 1' => array(
                'type' => 'text',
            ),
            'Tiêu đề cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Đường dẫn cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Tiêu đề cột thông tin 3' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 3' => array(
                'type' => 'textarea',
            ),
            'Đường dẫn cột thông tin 3' => array(
                'type' => 'text',
            ),
            'endBaCotThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBonCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '4 Cột thông tin'
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
            'Tiêu đề cột 4' => array(
                'type' => 'text',
            ),
            'Nội dung cột 4' => array(
                'type' => 'textarea',
            ),
            'endBonCotThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSliderBaiViet1' => array(
                'type' => 'startmodule',
                'label' => 'Slider bài viết 1',
            ),
            'Tiêu đề Slider 1' => array(
                'type' => 'text',
            ),
            'Mô tả Slider 1' => array(
                'type' => 'text',
            ),
            'Slider 1' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endSliderBaiViet1' => array(
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
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endKhachHangPhanHoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSliderBaiViet2' => array(
                'type' => 'startmodule',
                'label' => 'Slider bài viết 2',
            ),
            'Tiêu đề slider 2' => array(
                'type' => 'text',
            ),
            'Mô tả slider 2' => array(
                'type' => 'text',
            ),
            'Slider 2' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endSliderBaiViet2' => array(
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
        'Header' => array(
            'Địa chỉ' => array(
                'type' => 'text',
            ),
            'Số điện thoại' => array(
                'type' => 'text',
            ),
            'Email liên hệ' => array(
                'type' => 'text',
            ),
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