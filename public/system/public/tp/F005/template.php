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
            'startDanhMucGiua' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục giữa'
            ),

            'Tiêu đề danh mục giữa' => array(
                'type' => 'text',
            ),
            'Tiêu đề nhỏ' => array(
                'type' => 'text',
            ),
            'Tiêu đề danh mục 1' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề danh mục 2' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'Tiêu đề danh mục 3' => array(
                'type' => 'text',
            ),
            'Sản phẩm danh mục 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endDanhMucGiua' => array(
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
            'Tiêu đề mô tả sản phẩm mới' => array(
                'type' => 'text',
            ),
            'Sản phẩm mới' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 4,
            ),
            'endSanPhamMoi' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

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
            /**** end ****/

            /**** start *****/
            'startTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức'
            ),
            'Tiêu đề tin tức' => array(
                'type' => 'text',
            ),
            'Tiêu đề mô tả tin tức' => array(
                'type' => 'text',
            ),
            'Tin tức mới' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 3,
            ),
            'endTinTuc' => array(
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
        'Header' => array(
            'Văn bản đầu trang phải' => array(
                'type' => 'textarea'
            ),
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