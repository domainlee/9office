<?php 
namespace Menu;

use \Zend\Navigation\Navigation;

class Admin extends Navigation
{
	public function __construct()
	{
		$this->addPages(array(
//            array(
//                'icon'  => '<i class="ion-earth"></i>',
//                'label'	=> 'Website',
//                'class' => 'fa fa-dot-circle-o',
//                'uri'	=> '/admin/setup',
//                'resource' => 'admin:setup',
//                'privilege' => 'index',
//                'module' => 'setup',
//                'pages'	=> array(
//                    array(
//                        'label'	=> 'Trang nội dung',
//                        'label2'=> 'trang',
//                        'uri'	=> '/admin/page',
//                        'resource' => 'admin:page',
//                        'privilege' => 'index',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Menu',
//                        'label2'=> 'Menu',
//                        'uri'	=> '/admin/setup/menu',
//                        'resource' => 'admin:setup',
//                        'privilege' => 'menu',
//                        'class'=>'fa fa-list-ul'
//                    ),
//                    array(
//                        'label'	=> 'Giao diện',
//                        'label2'=> 'Trang chủ',
//                        'uri'	=> '/admin/setup/template',
//                        'resource' => 'admin:setup',
//                        'privilege' => 'template',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Liên hệ',
//                        'label2'=> 'Liên hệ',
//                        'uri'	=> '/admin/user/contact',
//                        'resource' => 'admin:user',
//                        'privilege' => 'contact',
//                    ),
//                )
//            ),

            array(
                'icon'  => '<i class="ti-shopping-cart"></i>',
                'label'	=> 'Đơn hàng',
                'label2'=> 'Đơn hàng',
                'uri'	=> '/admin/order?page=1&status=Confirmed',
                'resource' => 'admin:order',
                'privilege' => 'index',
                'class'=>'fa fa-plus-square',
            ),
            array(
                'icon'  => '<i class="ti-pencil-alt"></i>',
                'label'	=> 'Vật liệu',
                'uri'	=> '/admin/material',
                'resource' => 'admin:material',
                'privilege' => 'index',
                'class' => 'fa fa-dot-circle-o',
                'module' => 'material',
                'pages'	=> array(
                    array(
                        'label'	=> 'Vật liệu',
                        'label2'=> 'material',
                        'uri'	=> '/admin/material',
                        'resource' => 'admin:material',
                        'privilege' => 'index',
                        'class'=>'fa fa-list-ul'
                    ),
                    array(
                        'label'	=> 'Nhà cung cấp',
                        'label2'=> 'Danh muc',
                        'uri'	=> '/admin/manufacture',
                        'resource' => 'admin:manufacture',
                        'privilege' => 'index',
                        'class'=>'fa fa-list-ul'
                    ),
                    array(
                        'label'	=> 'Sản phẩm vật liệu',
                        'label2'=> 'product',
                        'uri'	=> '/admin/material/product',
                        'resource' => 'admin:material',
                        'privilege' => 'product',
                        'class'=>'fa fa-list-ul',
                    ),
                    array(
                        'label'	=> 'Sản phẩm',
                        'label2'=> 'product',
                        'uri'	=> '/admin/material/productlist',
                        'resource' => 'admin:material',
                        'privilege' => 'productlist',
                        'class'=>'fa fa-list-ul',
                    ),
                )
            ),
            array(
                'icon'  => '<i class="ti-pencil-alt"></i>',
                'label'	=> 'Hoá đơn',
                'uri'	=> '/admin/invoice',
                'resource' => 'admin:invoice',
                'privilege' => 'index',
                'class' => 'fa fa-dot-circle-o',
                'module' => 'invoice',
                'pages'	=> array(
                    array(
                        'label'	=> 'Hoá đơn',
                        'label2'=> 'bai viet',
                        'uri'	=> '/admin/invoice/index',
                        'resource' => 'admin:invoice',
                        'privilege' => 'index',
                        'class'=>'fa fa-list-ul',
                    ),
                    array(
                        'label'	=> 'Nhập hàng',
                        'label2'=> 'bai viet',
                        'uri'	=> '/admin/invoice/add',
                        'resource' => 'admin:invoice',
                        'privilege' => 'add',
                        'class'=>'fa fa-list-ul',
                    ),
//                    array(
//                        'label'	=> 'Xuất - bởi đơn hàng',
//                        'label2'=> 'Danh muc',
//                        'uri'	=> '/admin/invoice/order',
//                        'resource' => 'admin:invoice',
//                        'privilege' => 'order',
//                        'class'=>'fa fa-list-ul'
//                    ),
                    array(
                        'label'	=> 'Xuất hàng',
                        'label2'=> 'Danh muc',
                        'uri'	=> '/admin/invoice/other',
                        'resource' => 'admin:invoice',
                        'privilege' => 'other',
                        'class'=>'fa fa-list-ul'
                    ),
                )
            ),

//            array(
//                'icon'  => '<i class="ti-shopping-cart"></i>',
//                'label'	=> 'Sản phẩm',
//                'class' => 'fa fa-dot-circle-o',
//                'uri'	=> '#',
//                'resource' => 'admin:product',
//                'privilege' => 'index',
//                'module' => 'product',
//
//                'pages'	=> array(
//                    array(
//                        'label'	=> 'Sản phẩm',
//                        'label2'=> 'San pham',
//                        'uri'	=> '/admin/product',
//                        'resource' => 'admin:product',
//                        'privilege' => 'index',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Danh mục',
//                        'label2'=> 'Danh muc',
//                        'uri'	=> '/admin/product/category',
//                        'resource' => 'admin:product',
//                        'privilege' => 'category',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Thương hiệu',
//                        'label2'=> 'thuong hieu',
//                        'uri'	=> '/admin/product/brand',
//                        'resource' => 'admin:product',
//                        'privilege' => 'brand',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Thuộc tính',
//                        'label2'=> 'thuoc tinh',
//                        'uri'	=> '/admin/product/attr',
//                        'resource' => 'admin:product',
//                        'privilege' => 'attr',
//                        'class'=>'fa fa-list-ul',
//                    ),
//                    array(
//                        'label'	=> 'Đơn hàng',
//                        'label2'=> 'Đơn hàng',
//                        'uri'	=> '/admin/product/order',
//                        'resource' => 'admin:product',
//                        'privilege' => 'order',
//                        'class'=>'fa fa-plus-square',
//                    ),
//                    array(
//                        'label'	=> 'Bán hàng - POS',
//                        'label2'=> 'ban hang',
//                        'uri'	=> '/admin/product/sale',
//                        'resource' => 'admin:product',
//                        'privilege' => 'sale',
//                        'class'=>'fa fa-plus-square',
//                    ),
//                )
//            ),
//            array(
//                'icon'  => '<i class="ti-gallery"></i>',
//                'label'	=> 'Hình ảnh',
//                'class' => 'fa fa-dot-circle-o',
//                'uri'	=> '/admin/media/banner',
//                'resource' => 'admin:media',
//                'privilege' => 'index',
//                'module' => 'media',
//                'pages'	=> array(
//                    array(
//                        'label'	=> 'Hình ảnh',
//                        'label2'=> 'danh sach san pham',
//                        'uri'	=> '/admin/media/banner',
//                        'resource' => 'admin:media',
//                        'privilege' => 'banner',
//                        'class'=>'fa fa-list-ul'
//                    ),
//                )
//            ),
            array(
                'icon'  => '<i class="ti-user"></i>',
                'label'	=> 'Tài khoản',
                'uri'	=> '/admin/user',
                'resource' => 'admin:user',
                'privilege' => 'index',
                'pages'	=> array(
                    array(
                        'label'	=> 'Danh sách',
                        'uri'	=> '/admin/user',
                        'resource' => 'admin:user',
                        'privilege' => 'index',
                        'class'=>'fa fa-list-ul'
                    ),
//                    array(
//                        'label'	=> 'Danh sách tên miền',
//                        'uri'	=> '/admin/user/domain',
//                        'resource' => 'admin:user',
//                        'privilege' => 'domain',
//                        'class'=>'fa fa-list-ul'
//                    ),
//                    array(
//                        'label'	=> 'Danh sách liên hệ',
//                        'uri'	=> '/admin/user/contact',
//                        'resource' => 'admin:user',
//                        'privilege' => 'contact',
//                        'class'=>'fa fa-list-ul'
//                    ),
                )
            ),
            array(
                'icon'  => '<i class="ti-settings"></i>',
                'label'	=> 'Cấu hình',
                'class' => 'fa fa-dot-circle-o',
                'uri'	=> '/admin/setup',
                'resource' => 'admin:setup',
                'privilege' => 'index',
                'module' => 'setup',
            ),
//            array(
//                'icon'  => '<i class="ti-harddrives"></i>',
//                'label'	=> 'Doanh nghiệp',
//                'uri'	=> '/admin/store',
//                'resource' => 'admin:store',
//                'privilege' => 'index',
//                'class' => 'fa fa-dot-circle-o',
//                'module' => 'store',
//                'pages'	=> array(
//                    array(
//                        'label'	=> 'Danh sách',
//                        'uri'	=> '/admin/store',
//                        'resource' => 'admin:store',
//                        'privilege' => 'index',
//                        'class'=>'fa fa-list-ul'
//                    ),
//                    array(
//                        'label'	=> 'Tên miền',
//                        'uri'	=> '/admin/store/domain',
//                        'resource' => 'admin:store',
//                        'privilege' => 'domain',
//                        'class'=>'fa fa-plus-square'
//                    ),
//                    array(
//                        'label'	=> 'Giao diện',
//                        'uri'	=> '/admin/store/template',
//                        'resource' => 'admin:store',
//                        'privilege' => 'template',
//                        'class'=>'fa fa-plus-square'
//                    ),
//                    array(
//                        'label'	=> 'Công việc',
//                        'uri'	=> '/admin/question/task',
//                        'resource' => 'admin:question',
//                        'privilege' => 'task',
//                        'class'=>'fa fa-plus-square'
//                    ),
//                ),
//            ),

        ));
	}
}
