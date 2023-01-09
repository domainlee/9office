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
            'Tiêu đề nội dung bên phải banner' => array(
                'type' => 'text',
            ),
            'Dòng 1' => array(
                'type' => 'text',
            ),
            'Dòng 2' => array(
                'type' => 'text',
            ),
            'Dòng 3' => array(
                'type' => 'text',
            ),
            'Dòng 4' => array(
                'type' => 'text',
            ),
            'endBanner' => array(
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
            'startDanhMucSanPham' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục sản phẩm'
            ),
            'Danh mục sản phẩm' => array(
                'type' => 'selectmulti',
                'name' => 'categoryproduct',
                'limit' => 10,
                'description' => 'Hiển thị danh mục và danh sách sản phẩm thuộc danh mục đó'
            ),
            'endDanhMucSanPham' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startTabSanPhamSidebar' => array(
                'type' => 'startmodule',
                'label' => 'Tab Sản phẩm sidebar'
            ),
            'Tiêu đề tab sidebar' => array(
                'type' => 'text',
            ),
            'Tiêu đề tab số 1' => array(
                'type' => 'text',
            ),
            'Tab sản phẩm 1' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 15,
            ),
            'Tiêu đề tab số 2' => array(
                'type' => 'text',
            ),
            'Tab sản phẩm 2' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 15,
            ),
            'Tiêu đề tab số 3' => array(
                'type' => 'text',
            ),
            'Tab sản phẩm 3' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 15,
            ),
            'Ảnh tab banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endSanPhamSidebar' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startSanPhamSidebar' => array(
                'type' => 'startmodule',
                'label' => 'Sản phẩm sidebar'
            ),
            'Tiêu đề sidebar' => array(
                'type' => 'text',
            ),
            'Sản phẩm sidebar' => array(
                'type' => 'selectmulti',
                'name' => 'product',
                'limit' => 30,
            ),
            'Ảnh banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endTabSanPhamSidebar' => array(
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
            'startHeader1' => array(
                'type' => 'startmodule',
                'label' => 'Header 1',
            ),
            'Hỗ trợ' => array(
                'type' => 'text',
            ),
            'Từ khoá tìm kiếm' => array(
                'type' => 'text',
                'description' => 'Từ khoá dưới thanh search, các từ cách nhau (,). Ví dụ: iPhone, Sơ mi, Jean',
            ),
            'endHeader1' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/

            /**** start *****/
            'startHeader2' => array(
                'type' => 'startmodule',
                'label' => 'Header 2',
            ),
            'Ô thông tin 1' => array(
                'type' => 'text',
                'description' => 'Các ô thông tin bên phải logo',
            ),
            'Ô thông tin 2' => array(
                'type' => 'text',
            ),
            'Ô thông tin 3' => array(
                'type' => 'text',
            ),
            'Ô thông tin 4' => array(
                'type' => 'text',
            ),
            'Ô thông tin 5' => array(
                'type' => 'text',
            ),
            'endHeader2' => array(
                'type' => 'endmodule',
            ),
            /**** end *****/
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
            'Đường dẫn' => array(
                'type' => 'text',
                'description' => 'VD: http://dweb.vn/; https://www.google.com.vn/; ...',
            ),
            'Từ Copyright' => array(
                'type' => 'text',
                'description' => 'Từ chứa đường dẫn, VD: <a href="http://dweb.vn/" style="color: #98a6ad;">DWEB.VN</a>',
            ),
            'endCopyRight' => array(
                'type' => 'endmodule'
            ),
            /**** end *****/
        ),
    );

    return $a;
?>