<?php
    $a = array(
        'Trang chủ' => array(
            /**** start *****/
            'startBanner' => array(
                'type' => 'startmodule',
                'label' => 'Banner quảng cáo'
            ),
            'Banner' => array(
                'type' => 'selectmulti',
                'name' => 'banner',
                'limit' => 1,
            ),
            'endBanner' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Tin tức đầu trang'
            ),
            'Bài viết nổi bật' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 1,
            ),
            '4 Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 4,
                'description' => 'Dưới bài viết nổi bật',
            ),
            '8 Bài viết' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 8,
                'description' => 'Bên phải bài viết nổi bật',
            ),
            'endTinTuc' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startDanhMucTinTuc' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục tin tức'
            ),
            'Danh mục tin tức' => array(
                'type' => 'selectmulti',
                'name' => 'categoryarticle',
                'limit' => 10,
                'description' => 'Hiển thị danh mục và bài viết thuộc danh mục',
            ),
            'endDanhMucTinTuc' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/


        ),
        'Sidebar' => array(

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

            /**** start *****/
            'startDanhMucTinTucSidebar' => array(
                'type' => 'startmodule',
                'label' => 'Danh mục tin tức Sidebar',
            ),
            'Tiêu đề danh mục tin tức sidebar' => array(
                'type' => 'text',
                'description' => 'Chọn danh mục tin tức tại phần Menu',
            ),
            'endDanhMucTinTucSidebar' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startMucBaiViet1' => array(
                'type' => 'startmodule',
                'label' => 'Mục bài viết 1'
            ),
            'Tiêu đề mục 1' => array(
                'type' => 'text',
            ),
            'Bài viết mục 1' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endMucBaiViet1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startMucBaiViet2' => array(
                'type' => 'startmodule',
                'label' => 'Mục bài viết 2'
            ),
            'Tiêu đề mục 2' => array(
                'type' => 'text',
            ),
            'Bài viết mục 2' => array(
                'type' => 'selectmulti',
                'name' => 'news',
                'limit' => 10,
            ),
            'endMucBaiViet2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

        ),
        'Header' => array(
            'Từ khoá' => array(
                'type' => 'text',
                'description' => 'Từ khoá dưới thanh search, các từ cách nhau (,). Ví dụ: iPhone, Sơ mi, Jean',
            ),
        ),
        'Footer' => array(
            /**** start *****/
            'startFooter1' => array(
                'type' => 'startmodule',
                'label' => 'Footer 1'
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
            'endFooter1' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/

            /**** start *****/
            'startFooter2' => array(
                'type' => 'startmodule',
                'label' => 'Footer 2'
            ),
            'Thông tin 1' => array(
                'type' => 'textarea',
            ),
            'Thông tin 2' => array(
                'type' => 'textarea',
            ),
            'endFooter2' => array(
                'type' => 'endmodule',
            ),
            /**** end ****/
        ),
    );

    return $a;
?>