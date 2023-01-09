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
                'description' => 'Banner trang chủ',
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBonBanner' => array(
                'type' => 'startmodule',
                'label' => '4 Banner'
            ),
            '4 Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 4,
            ),
            'endBonBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBaSliderSanPham' => array(
                'type' => 'startmodule',
                'label' => '3 slider sản phẩm'
            ),
            'Tiêu đề slider 1' => array(
                'type' => 'text',
            ),
            'Mô tả slider 1' => array(
                'type' => 'text',
            ),
            'Slider sản phẩm 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề slider 2' => array(
                'type' => 'text',
            ),
            'Mô tả slider 2' => array(
                'type' => 'text',
            ),
            'Slider sản phẩm 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề slider 3' => array(
                'type' => 'text',
            ),
            'Mô tả slider 3' => array(
                'type' => 'text',
            ),
            'Slider sản phẩm 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endBaSliderSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startHaiBanner' => array(
                'type' => 'startmodule',
                'label' => '2 Banner'
            ),
            '2 Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 2,
                'description' => '2 Banner giữa trang',
            ),
            'endHaiBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBaTabSanPham' => array(
                'type' => 'startmodule',
                'label' => '3 Tab sản phẩm'
            ),
            'Tiêu đề 3 tab sản phẩm' => array(
                'type' => 'text',
            ),
            'Mô tả 3 tab sản phẩm' => array(
                'type' => 'text',
            ),
            'Tiêu đề tab 1' => array(
                'type' => 'text',
            ),
            'Mô tả tab 1' => array(
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
            'Mô tả tab 2' => array(
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
            'Mô tả tab 3' => array(
                'type' => 'text',
            ),
            'Sản phẩm tab 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endBaTabSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/


            /**** start *****/
            'startBonCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '4 Cột thông tin'
            ),
            'Tiêu đề cột thông tin 1' => array(
                'type' => 'text',
                'description' => '4 cột dịch vụ ( Ví dụ: về chúng tôi, giở mở cửa, liên hệ), thẻ h3 & p bạn không nên sửa',
            ),
            'Mô tả cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 3' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 3' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 4' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 4' => array(
                'type' => 'textarea',
            ),
            'endBonCotThongTin' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startPhanHoiKhachHang' => array(
                'type' => 'startmodule',
                'label' => 'Phản hồi khách hàng'
            ),
            'Tiêu đề phản hồi khách hàng' => array(
                'type' => 'text',
            ),
            'Mô tả  phản hồi khách hàng' => array(
                'type' => 'text',
            ),
            'Phản hồi khách hàng' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
                'description' => 'Phản hồi của khách hàng',
            ),
            'endPhanHoiKhachHang' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức'
            ),
            'Tiêu đề tin tức' => array(
                'type' => 'text',
                'description' => 'Tiêu đề, tiêu đề nhỏ, lựa chọn bài viết (2 bài viết)',
            ),
            'Mô tả tin tức' => array(
                'type' => 'text',
            ),
            'Tin tức' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 2,
            ),
            'endTinTuc' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/
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
            'Văn bản đầu trang phải' => array(
                'type' => 'textarea'
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
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),
    );

    return $a;
?>