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
                'limit' => 1,
                'description' => 'Banner trang chủ',
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBannerPhai' => array(
                'type' => 'startmodule',
                'label' => 'Banner nhỏ bên phải'
            ),
            'Banner phải' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Nội dung trái banner' => array(
                'type' => 'textarea',
                'description' => 'Nội dung bên trái, bên phải lựa chọn một banner, thẻ h2, h3, p bạn không nên sửa',
            ),
            'endBannerPhai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDongChuQuangCao' => array(
                'type' => 'startmodule',
                'label' => 'Dòng chữ quảng cáo'
            ),
            'Tiêu đề quảng cáo' => array(
                'type' => 'text',
                'description' => 'Module giảm giá',
            ),
            'Nội dung quảng cáo' => array(
                'type' => 'text',
            ),
            'Tên đường dẫn' => array(
                'type' => 'text',
                'description' => 'Dòng chữ trên button',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
            ),
            'endDongChuQuangCao' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaTabSanPham' => array(
                'type' => 'startmodule',
                'label' => '3 Tab sản phẩm',
            ),
            'Tiêu đề' => array(
                'type' => 'text',
                'description' => '( 3 tab ) Tiêu đề, tiêu đề nhỏ, các tab sản phẩm ',
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
            'endBaTabSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSliderChu' => array(
                'type' => 'startmodule',
                'label' => 'Slider chữ'
            ),
            'Tiêu đề slider' => array(
                'type' => 'text',
            ),
            'Nội dung slider 1' => array(
                'type' => 'text',
            ),
            'Nội dung slider 2' => array(
                'type' => 'text',
            ),
            'Nội dung slider 3' => array(
                'type' => 'text',
            ),
            'endSliderChu' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startBonCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '4 Cột thông tin',
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

        ),
    );

    return $a;
?>