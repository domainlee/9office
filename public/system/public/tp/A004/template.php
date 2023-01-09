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
                'limit' => 10,
                'description' => 'Banner trên cùng'
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startGioiThieu' => array(
                'type' => 'startmodule',
                'label' => 'Giới thiệu'
            ),
            'Giới thiệu' => array(
                'type' => 'textarea',
                'description' => 'Giới thiệu'
            ),
            'endGioiThieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDuAnTieuBieu' => array(
                'type' => 'startmodule',
                'label' => 'Dự án tiêu biểu'
            ),
            'Tiêu đề dự án tiêu biểu nhỏ' => array(
                'type' => 'text',
            ),
            'Tiêu đề dự án tiêu biểu lớn' => array(
                'type' => 'text',
            ),
            'Mô tả dự án tiêu biểu' => array(
                'type' => 'text',
            ),
            'Dự án tiêu biểu' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 4,
                'description' => '4 Dự án tiêu biểu'
            ),
            'Button' => array(
                'type' => 'text',
                'description' => 'Dòng chữ trên button',
            ),
            'Đường dẫn button' => array(
                'type' => 'text',
            ),
            'endDuAnTieuBieu' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startKhachHang' => array(
                'type' => 'startmodule',
                'label' => 'Khách hàng'
            ),
            'Tiêu đề khách hàng nhỏ' => array(
                'type' => 'text',
            ),
            'Tiêu đề khách hàng lon' => array(
                'type' => 'text',
            ),
            'Nhận xét của khách hàng 1' => array(
                'type' => 'textarea',
            ),
            'Tên khách hàng 1' => array(
                'type' => 'text',
            ),
            'Nhận xét của khách hàng 2' => array(
                'type' => 'textarea',
            ),
            'Tên khách hàng 2' => array(
                'type' => 'text',
            ),
            'Nhận xét của khách hàng 3' => array(
                'type' => 'textarea',
            ),
            'Tên khách hàng 3' => array(
                'type' => 'text',
            ),
            'endKhachHang' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTabBaiViet' => array(
                'type' => 'startmodule',
                'label' => '5 Tab bài viết'
            ),
            'Tiêu đề tab bài viết' => array(
                'type' => 'text',
            ),
            'Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 5,
                'description' => 'Bài viết'
            ),
            'endTabBaiViet' => array(
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
        'Header' => array(
            'Văn bản đầu trang phải' => array(
                'type' => 'textarea'
            ),
        ),
        'Footer' => array(
            /**** start *****/
            'startFooter1' => array(
                'type' => 'startmodule',
                'label' => 'Footer 1'
            ),
            'Tiêu đề cột thông tin 1' => array(
                'type' => 'text',
            ),

            'Thông tin cột thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột thông tin 2' => array(
                'type' => 'text',
            ),

            'Thông tin cột thông tin 2' => array(
                'type' => 'textarea',
            ),
            'Tiêu đề cột mạng xã hội' => array(
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
            'endFooter1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startFooter2' => array(
                'type' => 'startmodule',
                'label' => 'Footer 2'
            ),
            'Copyright' => array(
                'type' => 'text',
            ),
            'Thiết kế bởi' => array(
                'type' => 'text',
            ),
            'Đường dẫn' => array(
                'type' => 'text',
            ),
            'endFooter2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/


        ),
    );

    return $a;
?>