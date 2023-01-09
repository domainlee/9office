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
        'startBaBannerNho' => array(
            'type' => 'startmodule',
            'label' => '3 Banner nhỏ'
        ),
        '3 Banner' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 3,
        ),
        'endBaBannerNho' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startBonTabSanPham' => array(
            'type' => 'startmodule',
            'label' => '4 Tab Sản phẩm'
        ),
        'Tiêu đề tab 1' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm tab 1' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 4,
        ),
        'Tiêu đề tab 2' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm tab 2' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 4,
        ),
        'Tiêu đề tab 3' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm tab 3' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 4,
        ),
        'Tiêu đề tab 4' => array(
            'type' => 'text',
            'value' => '',
        ),
        'Sản phẩm tab 4' => array(
            'type' => 'selectmulti',
            'name' => 'product',
            'limit' => 4,
        ),
        'end4TabSanPham' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhMucSanPham1' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 1'
        ),
        'Danh mục sản phẩm 1' => array(
            'type' => 'selectmulti',
            'name' => 'categoryproduct',
            'limit' => 1,
            'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
        ),
        'endDanhMucSanPham1' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startHaiBannerGiua1' => array(
            'type' => 'startmodule',
            'label' => '2 Banner giữa 1'
        ),
        '2 Banner giữa 1' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 2,
        ),
        'endHaiBannerGiua1' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhMucSanPham2' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 2'
        ),
        'Danh mục sản phẩm 2' => array(
            'type' => 'selectmulti',
            'name' => 'categoryproduct',
            'limit' => 1,
            'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
        ),
        'endDanhMucSanPham2' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhMucSanPham3' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 3'
        ),
        'Danh mục sản phẩm 3' => array(
            'type' => 'selectmulti',
            'name' => 'categoryproduct',
            'limit' => 1,
            'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
        ),
        'endDanhMucSanPham3' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhMucSanPham4' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm 4'
        ),
        'Danh mục sản phẩm 4' => array(
            'type' => 'selectmulti',
            'name' => 'categoryproduct',
            'limit' => 1,
            'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
        ),
        'endDanhMucSanPham4' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startHaiBannerGiua2' => array(
            'type' => 'startmodule',
            'label' => '2 Banner giữa 2'
        ),
        '2 Banner giữa 2' => array(
            'type' => 'selectmulti',
            'name' => 'banner',
            'limit' => 2,
        ),
        'endHaiBannerGiua2' => array(
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
    'Sidebar' => array(
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
    'Header' => array(
        /**** start *****/
        'Khuyến mãi' => array(
            'type' => 'text',
        ),
        'Tư vấn hỗ trợ' => array(
            'type' => 'text',
        ),
        'Từ khoá' => array(
            'type' => 'text',
            'description' => 'Từ khoá dưới thanh search, các từ cách nhau (,). Ví dụ: iPhone, Sơ mi, Jean',
        ),
        /**** end *****/

    ),
    'Footer' => array(

        /**** start *****/
        'startCotGioiThieu' => array(
            'type' => 'startmodule',
            'label' => 'Giới thiệu'
        ),
        'Nội dung giới thiệu' => array(
            'type' => 'textarea',
        ),
        'Facebook' => array(
            'type' => 'text',
        ),
        'Youtube' => array(
            'type' => 'text',
        ),
        'endGioiThieu' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhSachLienKet1' => array(
            'type' => 'startmodule',
            'label' => 'Danh sách liên kết 1'
        ),
        'Tiêu đề danh sách liên kết 1' => array(
            'type' => 'text',
            'description' => 'Tạo các liên kết tại Website > Menu > Danh mục footer 1'
        ),
        'endDanhSachLienKet1' => array(
            'type' => 'endmodule',
        ),
        /**** end *****/

        /**** start *****/
        'startDanhSachLienKet2' => array(
            'type' => 'startmodule',
            'label' => 'Danh sách liên kết 2'
        ),
        'Tiêu đề danh sách liên kết 2' => array(
            'type' => 'text',
            'description' => 'Tạo các liên kết tại Website > Menu > Danh mục footer 2'
        ),
        'endDanhSachLienKet2' => array(
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
        'startDanhMucSanPhamFooter' => array(
            'type' => 'startmodule',
            'label' => 'Danh mục sản phẩm footer'
        ),
        'Danh mục sản phẩm footer' => array(
            'type' => 'selectmulti',
            'name' => 'categoryproduct',
            'limit' => 10,
            'description' => 'Hiển thị danh mục và danh mục con mặc định'
        ),
        'endDanhMucSanPhamFooter' => array(
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
            'description' => 'Nội dung phần Copyright',
        ),
        'endCopyRight' => array(
            'type' => 'endmodule'
        ),
        /**** end *****/
    ),
);

return $a;
?>