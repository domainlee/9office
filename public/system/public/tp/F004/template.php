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

            /**** start *****/
            'startBannerTrai' => array(
                'type' => 'startmodule',
                'label' => 'Banner trái'
            ),
            'Banner trái' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Tiêu đề danh mục phải' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục phải' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 10,
            ),
            'endBannerTrai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDanhMucTrai' => array(
                'type' => 'startmodule',
                'label' => 'Banner phải'
            ),
            'Banner phải' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'Tiêu đề danh mục trái' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục trái' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 10,
            ),
            'endBannerPhai' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDanhMucGiua' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục giữa'
            ),
            'Tiêu đề danh mục giữa' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục giữa' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endDanhMucGiua' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startBaCotThongTin' => array(
                'type' => 'startmodule',
                'label' => '3 cột thông tin'
            ),
            'Cột thông tin 1' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Cột thông tin 2' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Cột thông tin 3' => array(
                'type' => 'text',
            ),
            'Mô tả cột thông tin 3' => array(
                'type' => 'textarea',
            ),
            'endBaCotThongTin' => array(
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
            'Tiêu đề danh muc tin tức 1' => array(
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
        'Footer' => array(
            /**** start *****/
            'startCotThongTinFooter1' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 1'
            ),
            'Nội dung cột thông tin 1' => array(
                'type' => 'text',
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
                'type' => 'text',
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