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
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'start3CotThongTinDuoiBanner' => array(
                'type' => 'startmodule',
                'label' => '3 Cột thông tin dưới banner'
            ),
            'Tiêu đề cột 1' => array(
                'type' => 'text',
            ),
            'Nội dung cột 1' => array(
                'type' => 'text',
            ),
            'Tiêu đề cột 2' => array(
                'type' => 'text',
            ),
            'Nội dung cột 2' => array(
                'type' => 'text',
            ),
            'Tiêu đề cột 3' => array(
                'type' => 'text',
            ),
            'Nội dung cột 3' => array(
                'type' => 'text',
            ),
            'end3CotThongTinDuoiBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startBonBannerNho' => array(
                'type' => 'startmodule',
                'label' => '4 Banner nhỏ'
            ),
            'Tiêu đề 4 banner nhỏ' => array(
                'type' => 'text',
            ),
            'Mô tả 4 banner nhỏ' => array(
                'type' => 'text',
            ),
            '4 Banner nhỏ' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 4,
            ),
            'endBonBannerNho' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startMotBannerLon' => array(
                'type' => 'startmodule',
                'label' => '1 Banner lớn'
            ),
            '1 Banner lớn' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endMotBannerLon' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startSanPhamMoi' => array(
                'type' => 'startmodule',
                'label' => 'Sản phẩm mới'
            ),
            'Tiêu đề sản phẩm mới' => array(
                'type' => 'text',
            ),
            'Mô tả sản phẩm mới' => array(
                'type' => 'text',
            ),
            'Sản phẩm mới' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 8,
            ),
            'endSanPhamMoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startHaiBannerLon' => array(
                'type' => 'startmodule',
                'label' => '2 Banner lớn'
            ),
            '2 Banner lớn' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 2,
            ),
            'endHaiBannerLon' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startMotBannerLonDuoi' => array(
                'type' => 'startmodule',
                'label' => '1 Banner Lớn Dưới'
            ),
            '1 Banner lớn dưới' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endMotBannerLonDuoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTinTucMoi' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức mới'
            ),
            'Tiêu đề tin tức mới' => array(
                'type' => 'text',
            ),
            'Mô tả tin tức mới' => array(
                'type' => 'text',
            ),
            'Tin tức mới' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'endTinTucMoi' => array(
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
            'Tiêu đề danh muc tin tức 2' => array(
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
            'Địa chỉ' => array(
                'type' => 'text',
            ),
            'Số điện thoại' => array(
                'type' => 'text',
            ),
        ),
        'Footer' => array(
            /**** start *****/
            'startCotThongTinFooter1' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 1'
            ),
            'Nội dung cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'endCotThongTinFooter1' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startCotThongTinFooter2' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 2'
            ),
            'Tiêu đề cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'endCotThongTinFooter2' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startCotThongTinFooter3' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 3'
            ),
            'Tiêu đề cột thông tin 3' => array(
                'type' => 'text',
            ),
            'Youtube' => array(
                'type' => 'text',
            ),
            'Facebook' => array(
                'type' => 'text',
            ),
            'Twitter' => array(
                'type' => 'text',
            ),
            'Instagram' => array(
                'type' => 'text',
            ),
            'Pinterest' => array(
                'type' => 'text',
            ),
            'endCotThongTinFooter3' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

        ),
    );

    return $a;
?>