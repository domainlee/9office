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
            'startBaBanner' => array(
                'type' => 'startmodule',
                'label' => '3 Banner'
            ),
            'Tiêu đề 3 banner' => array(
                'type' => 'text',
            ),
            'Mô tả 3 banner' => array(
                'type' => 'text',
                'description' => '3 Banner nhỏ dưới banner lớn',
            ),
            '3 Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 3,
            ),
            'endBaBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBannerTrai' => array(
                'type' => 'startmodule',
                'label' => 'Banner trái'
            ),
            'Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
                'description' => 'Banner trái, bên phải có 4 bài viết',
            ),
            '4 bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 4,
            ),
            'endBannerTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBaiVietNoiBat' => array(
                'type' => 'startmodule',
                'label' => 'Bài viết nổi bật'
            ),
            'Tiêu đề cột thông tin bên trái' => array(
                'type' => 'text',
            ),
            'Cột thông tin bên trái' => array(
                'type' => 'textarea',
            ),
            'Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 1,
            ),
            'endBaiVietNoiBat' => array(
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
            /**** end *****/

            /**** start *****/
            'startBannerGiua' => array(
                'type' => 'startmodule',
                'label' => 'Banner giữa'
            ),
            'Banner giữa' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endBannerGiua' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBaCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 Cột thông tin'
            ),
            'Cột thông tin 1' => array(
                'type' => 'textarea',
                'description' => '3 cột dịch vụ ( Ví dụ: về chúng tôi, giở mở cửa, liên hệ), thẻ h3 & p bạn không nên sửa',
            ),
            'Cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Cột thông tin 3' => array(
                'type' => 'textarea',
            ),
            'endBaCotThongTin' => array(
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