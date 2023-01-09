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
            'Tiêu đề cột thông tin 1' => array(
                'type' => 'text',
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
                'description' => 'Chọn danh mục tại phần menu'
            ),
            'endCotThongTinFooter2' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startCotThongTinFooter3' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 3',
            ),
            'Tiêu đề cột thông tin 3' => array(
                'type' => 'text',
                'description' => 'Chọn danh mục tại phần menu'
            ),
            'endCotThongTinFooter3' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startCotThongTinFooter4' => array(
                'type' => 'startmodule',
                'label' => 'Cột thông tin footer 4'
            ),
            'Tiêu đề cột thông tin 4' => array(
                'type' => 'text',
            ),
            'Nội dung cột thông tin footer 4' => array(
                'type' => 'textarea',
            ),
            'endCotThongTinFooter4' => array(
                'type' => 'endmodule',
            ),

            /**** end ****/

            /**** start *****/
            'startCopyRight' => array(
                'type' => 'startmodule',
                'label' => 'Copyright',
            ),
            'Copyright' => array(
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
            'Linkedin' => array(
                'type' => 'text',
            ),
            'Mail' => array(
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