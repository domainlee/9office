<?php
$a = array(
    'Trang chủ' => array(
//            'Danh mục sản phẩm' => array(
//                'type' => 'selectmulti',
//                'name' => 'categoryproduct',
//                'limit' => 8,
//            ),
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
        'startHaiBanner' => array(
            'type' => 'startmodule',
            'label' => '2 Banner'
        ),
        '2 Banner' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 2,
        ),
        'endHaiBanner' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startNoiDungGiuaTrang' => array(
            'type' => 'startmodule',
            'label' => 'Nội dung giữa trang'
        ),
        'Nôi dung giữa trang' => array(
            'type' => 'text',
        ),
        'endNoiDungGiuaTrang' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startTinTuc' => array(
            'type' => 'startmodule',
            'label' => 'Tin tức'
        ),
        'Tiêu đề Tin tức' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Tin tức' => array(
            'type' => 'selectmulti',
            'name' => 'news',
            'limit' => 3,
        ),
        'endTinTuc' => array(
            'type' => 'endmodule',
        ),
        /**** end ****/

        /**** start *****/
        'startBaSanPham' => array(
            'type' => 'startmodule',
            'label' => '3 sản phẩm'
        ),
        'Tiêu đề 3 sản phẩm' => array(
            'type' => 'text',
            'value' => '',
        ),
        '3 Sản phẩm' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 3,
        ),
        'endBaSanPham' => array(
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
        'Đoạn text bên phải' => array(
            'type' => 'text',
        ),
        'Đoạn text bên trái' => array(
            'type' => 'text',
        ),
    ),
    'Footer' => array(

        /**** start *****/
        'startCotThongTinFooter1' => array(
            'type' => 'startmodule',
            'label' => 'Cột thông tin Footer 1'
        ),
        'Tiêu đề cột thông tin 1' => array(
            'type' => 'text',
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
            'label' => 'Cột thông tin Footer 2'
        ),
        'Tiêu đề cột thông tin 2' => array(
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