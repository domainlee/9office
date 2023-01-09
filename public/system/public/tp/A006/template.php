
<?php
/************/
// Chú thích
// Banner là một key trong array, có type là selectmulti, kiểu dữ liệu 'banner' (banner, news, product, page).
// //
/************/
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
            'startTinTuc1' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức 1'
            ),
            '7 Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 7,
            ),
            'endTinTuc1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start3OThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 Ô thông tin'
            ),
            'Tiêu đề ô thông tin 1' => array(
                'type' => 'text',
            ),

            'Nội dung ô thông tin 1' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô thông tin 2' => array(
                'type' => 'text',
            ),

            'Nội dung ô thông tin 2' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô thông tin 3' => array(
                'type' => 'text',
            ),

            'Nội dung ô thông tin 3' => array(
                'type' => 'text',
            ),
            'end3OThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startThongTinQuangCao1' => array(
                'type' => 'startmodule',
                'label' => 'Thông tin quảng cáo 1'
            ),
            'Tiêu đề quảng cáo 1' => array(
                'type' => 'text',
            ),
            'Nội dung quảng cáo 1' => array(
                'type' => 'textarea',
            ),
            'endThongTinQuangCao1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startThuVien' => array(
                'type' => 'startmodule',
                'label' => 'Thư viện'
            ),
            'Thư viện' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 10,
            ),
            'endThuVien' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'start6OThongTin' => array(
                'type' => 'startmodule',
                'label' => '6 Ô thông tin'
            ),
            'Tiêu đề ô 1' => array(
                'type' => 'text',
            ),

            'Nội dung ô 1' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô 2' => array(
                'type' => 'text',
            ),

            'Nội dung ô 2' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô 3' => array(
                'type' => 'text',
            ),

            'Nội dung ô 3' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô 4' => array(
                'type' => 'text',
            ),

            'Nội dung ô 4' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô 5' => array(
                'type' => 'text',
            ),

            'Nội dung ô 5' => array(
                'type' => 'text',
            ),
            'Tiêu đề ô 6' => array(
                'type' => 'text',
            ),

            'Nội dung ô 6' => array(
                'type' => 'text',
            ),
            'end6OThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTinTuc2' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức 2'
            ),
            'Tiêu đề tin tức 2' => array(
                'type' => 'text',
            ),
            '3 bài viết bên trái' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'Tiêu đề danh sách bài viết bên phải' => array(
                'type' => 'text',
            ),
            'Danh sách bài viết bên phải' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 5,
            ),
            'endTinTuc2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/


            /**** start *****/
            'startDongChuQuangCao1' => array(
                'type' => 'startmodule',
                'label' => 'Dòng chữ quảng cáo 1'
            ),
            'Dòng chữ quảng cáo 1' => array(
                'type' => 'textarea',
            ),
            'endDongChuQuangCao1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startThongTinQuangCao2' => array(
                'type' => 'startmodule',
                'label' => 'Thông tin quảng cáo 2'
            ),
            'Tiêu đề quảng cáo 2' => array(
                'type' => 'text',
            ),
            'Nội dung quảng cáo 2' => array(
                'type' => 'textarea',
            ),
            'endThongTinQuangCao2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startCauHoiThuongGap' => array(
                'type' => 'startmodule',
                'label' => 'Câu hỏi thường gặp'
            ),
            'Tiêu đề câu hỏi thường gặp' => array(
                'type' => 'text',
            ),
            'Câu hỏi 1' => array(
                'type' => 'text',
            ),

            'Câu trả lời 1' => array(
                'type' => 'text',
            ),
            'Câu hỏi 2' => array(
                'type' => 'text',
            ),
            'Câu trả lời 2' => array(
                'type' => 'text',
            ),
            'Câu hỏi 3' => array(
                'type' => 'text',
            ),
            'Câu trả lời 3' => array(
                'type' => 'text',
            ),
            'Câu hỏi 4' => array(
                'type' => 'text',
            ),
            'Câu trả lời 4' => array(
                'type' => 'text',
            ),
            'endCauHoiThuongGap' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDongChuQuangCao2' => array(
                'type' => 'startmodule',
                'label' => 'Dòng chữ quảng cáo 2'
            ),
            'Dòng chữ quảng cáo 2' => array(
                'type' => 'textarea',
            ),
            'endDongChuQuangCao2' => array(
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
            'Thời gian làm viec' => array(
                'type' => 'text',
            ),
            'Dòng chữ bên phải' => array(
                'type' => 'text',
            ),
            'Dòng chữ bên trái' => array(
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
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),
    );

    return $a;
?>