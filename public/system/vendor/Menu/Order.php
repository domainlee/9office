<?php 
namespace Menu;

use \Zend\Navigation\Navigation;

class Order extends Navigation
{
	public function __construct()
	{
		$this->addPages(array(
            array(
                'icon'  => '<i class="ti-shopping-cart"></i>',
                'label'	=> 'Bán hàng',
                'class' => 'fa fa-dot-circle-o',
                'uri'	=> '/admin/product/sale',
                'resource' => 'admin:product',
                'privilege' => 'sale',
                'module' => 'sale',
                'pages'	=> array(
                    array(
                        'label'	=> 'Bán hàng',
                        'label2'=> 'don hang',
                        'uri'	=> '/admin/product/sale',
                        'resource' => 'admin:product',
                        'privilege' => 'sale',
                        'class'=>'fa fa-plus-square',
                    ),
                    array(
                        'label'	=> 'Đơn hàng',
                        'label2'=> 'don hang',
                        'uri'	=> '/admin/product/order',
                        'resource' => 'admin:product',
                        'privilege' => 'order',
                        'class'=>'fa fa-plus-square',
                    ),
                    array(
                        'label'	=> 'Khách hàng',
                        'label2'=> 'Khách hàng',
                        'uri'	=> '/admin/product/client',
                        'resource' => 'admin:product',
                        'privilege' => 'client',
                        'class'=>'fa fa-plus-square',
                    ),
                    array(
                        'label'	=> 'Báo cáo',
                        'label2'=> 'Báo cáo',
                        'uri'	=> '/admin/product/reportsale',
                        'resource' => 'admin:product',
                        'privilege' => 'reportsale',
                        'class'=>'fa fa-plus-square',
                    ),
                )
            ),

        ));
	}
}
