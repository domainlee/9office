<?php
/**
* @category   	Restaurant library
* @copyright  	http://restaurant.vn
* @license    	http://restaurant.vn/license
*/

namespace Authorize\Permission;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends ZendAcl
{

	public function __construct()
	{

        $this->addRole(new Role('Guest'));
		$this->addRole(new Role('Member'), 'Guest');
       
		$this->addRole(new Role('Admin'), 'Member');
		$this->addRole(new Role('Super Admin'), 'Admin');

		$this->addResource('home:index');
        $this->addResource('home:contact');
        $this->addResource('home:search');
        $this->addResource('home:page');
        $this->addResource('home:layout');

		$this->addResource('user:user');
// 		$this->addResource('user:profile');
// 		$this->addResource('user:signin');
// 		$this->addResource('user:signout');

		$this->addResource('order:order');
        $this->addResource('order:cart');

        $this->addResource('article:article');
        $this->addResource('news:news');

        $this->addResource('product:product');
 		$this->addResource('pro:pro');

		$this->addResource('admin:admin');
		$this->addResource('admin:article');
		$this->addResource('admin:articlec');
		$this->addResource('admin:product');
		$this->addResource('admin:productc');
		$this->addResource('admin:banner');
		$this->addResource('admin:position');
		$this->addResource('admin:store');
		$this->addResource('admin:order');
        $this->addResource('admin:media');
        $this->addResource('admin:setup');
        $this->addResource('admin:page');
        $this->addResource('admin:user');
        $this->addResource('admin:question');


        $this->addResource('payment:baokim');

		$this->allow('Guest', 'home:index',array('index','landing' , 'search','register', 'registerajax', 'active', 'rating', 'comment', 'listcomment', 'createdstep'));
        $this->allow('Guest', 'home:contact',array('index', 'contact', 'contactajax'));
        $this->allow('Guest', 'home:search',array('index'));
        $this->allow('Guest', 'home:page',array('index'));

        $this->allow('Guest', 'home:layout', array('index', 'suggestion'));
		//$this->allow('Guest', 'admin:admin',array('index'));
		$this->allow('Guest', 'user:user', array('signin', 'signout', 'signup', 'profile', 'getactivecode', 'getpassword','active', 'changepassword', 'token', 'datafacebook'));
		$this->allow('Guest', 'payment:baokim', array('bpn'));
		$this->allow('Guest', 'pro:pro', array('index'));
		$this->allow('Guest', 'product:product', array('index','view','category','child', 'viewall'));
		$this->allow('Guest', 'article:article', array('index','view','category'));
        $this->allow('Guest', 'news:news', array('index','view','category','tag','blog', 'blogview', 'price','theme'));

//        $this->allow('Guest', 'order:cart', array('index','add','remove'));
        $this->allow('Guest', 'order:cart', ['index', 'add', 'remove', 'checkout', 'cartsignin', 'quickAdd', 'addwaiting', 'change', 'success']);
        $this->allow('Guest', 'order:order', ['index', 'add', 'remove', 'checkout', 'cartsignin', 'quickAdd', 'addwaiting']);

        //member
        $this->allow('Admin', 'admin:admin', array('index', 'optionadmin'));
        $this->allow('Guest', 'admin:admin', array('huongdan'));
//        $this->allow('Admin', 'admin:page', array('index','add','edit','change','delete', 'homepage'));
//        $this->allow('Admin', 'admin:article', array('index','add','edit','category','addcategory', 'change','changec', 'delete', 'editcategory', 'deletec'));
//        $this->allow('Admin', 'admin:product', array('index','add','edit','delete', 'attr', 'deleteattr', 'loadattr', 'category', 'addcategory', 'editcategory', 'deletecategory', 'change', 'changec', 'order', 'orderview', 'brand', 'addbrand', 'editbrand', 'deletebrand', 'changeBrand', 'importexcel', 'type', 'related', 'changeorder', 'deleteorder'));
//        $this->allow('Admin', 'admin:media', array('index','upload','banner', 'add', 'editbanner', 'delete', 'change'));
//        $this->allow('Admin', 'admin:setup', array('index', 'menu'));
//        $this->allow('Admin', 'admin:user', array('index', 'add'));

//		$this->allow('Admin', 'admin:product', array('index','add','edit','delete', 'attr', 'deleteattr', 'loadattr', 'category', 'addcategory', 'editcategory', 'deletecategory', 'change', 'changec', 'order', 'orderview', 'brand', 'addbrand', 'editbrand', 'deletebrand', 'changeBrand', 'importexcel', 'type', 'related', 'changeorder', 'deleteorder'));
//		$this->allow('Admin', 'admin:productc', array('index','add','edit'));
//		$this->allow('Admin', 'admin:articlec', array('index','add','edit'));


//		$this->allow('Admin', 'admin:store', array('index','add','edit'));

        //admin
//		$this->allow('Admin', 'admin:article', array('delete'));
//		$this->allow('Admin', 'admin:product', array('delete'));
//		$this->allow('Admin', 'admin:banner', array('delete'));
//		$this->allow('Admin', 'admin:position', array('delete'));
//		$this->allow('Admin', 'admin:order', array('edit,delete,changeStatus'));


        $this->allow('Admin', 'admin:article', array('field', 'deletefield'));
        $this->allow('Admin', 'admin:product', array('field', 'deletefield', 'url'));
        $this->allow('Admin', 'admin:question', array('index', 'view', 'task'));
        $this->allow('Admin', 'admin:setup', array('page', 'changecomment', 'deleteccomment'));
//        $this->allow('Admin', 'admin:admin', array('huongdan'));

        $this->allow('Super Admin', null);

	}

	public function getDependencies()
    {
        return array(   'Tài khoản' => array(
                            'Xem danh sách tài khoản' => 'index',
                            'Thêm tài khoản' => 'add',
                            'Sửa tài khoản' => 'edit',
                            'Xoá tài khoản' => 'delete',
                            'Đổi trạng thái tài khoản' => 'change',
                            'Danh sách tên miền' => 'domain',
                            'Thêm website' => 'adddomain',
                            'Xoá website' => 'deletedomain',
                            'Danh sách liên hệ' => 'contact',
                            'Thêm khách hàng' => 'client',
                        ),
                        'Trang' => array(
                            'Xem danh sách trang' => 'index',
                            'Thêm trang' => 'add',
                            'Sửa trang' => 'edit',
                            'Xoá trang' => 'delete',
                            'Thay đổi trạng thái trang' => 'change',
                            'Tuỳ chỉnh trang' => 'homepage',
                        ),
                        'Cài đặt' => array(
                            'Tuỳ chỉnh cài đặt' => 'index',
                            'Quản lý menu' => 'menu',
                            'Thêm Script/CSS' => 'source',
                            'Giao diện trang chủ' => 'template',
                            'Cài đặt khác' => 'other',
                            'Robot / XML' => 'robot',
                            'Popup' => 'popup',
                            'Đổi giao diện' => 'skin',
                            'Danh sách bình luận' => 'comment',
                        ),

                        'Hình Ảnh' => array(
                            'Sử dụng hình ảnh' => 'index',
                            'Upload hình ảnh' => 'upload',
                            'Xem danh sách banner' => 'banner',
                            'Thêm banner' => 'add',
                            'Sửa banner' => 'editbanner',
                            'Xoá banner' => 'delete',
                            'Đổi trạng thái banner' => 'change',
                        ),
                        'Bài viết' => array(
                            'Xem danh sách bài viết' => 'index',
                            'Thêm bài viết' => 'add',
                            'Sửa bài viết' => 'edit',
                            'Đổi trạng thái bài viết' => 'change',
                            'Xoá bài viết' => 'delete',
                            'Xem danh sách danh mục' => 'category',
                            'Thêm danh mục' => 'addcategory',
                            'Đổi trạng thái danh mục' => 'changec',
                            'Sửa danh mục' => 'editcategory',
                            'Xoá danh mục' => 'deletec',
//                            'Thêm trường' => 'field',
                        ),
                        'Question' => array (
                            'Công việc' => 'task',
                        ),
                        'Sản phẩm' => array(
                            'Bán hàng' => 'sale',
                            'Tạo đơn hàng' => 'createorder',
                            'Danh sách khách hàng' => 'client',
                            'Báo cáo bán hàng' => 'reportsale',
                            'Xem danh sách sản phẩm' => 'index',
                            'Thêm sản phẩm' => 'add',
                            'Thêm sản phẩm file Excel' => 'importexcel',
                            'Sửa sản phẩm' => 'edit',
                            'Xoá sản phẩm' =>  'delete',
                            'Đổi trạng thái sản phẩm' =>  'change',
                            'Danh sách thuộc tính' => 'attr',
                            'Xoá thuộc thuộc tính' => 'deleteattr',
                            'Xem danh sách danh mục' => 'category',
                            'Thêm danh mục' => 'addcategory',
                            'Sửa danh mục' => 'editcategory',
                            'Xoá danh mục' => 'deletecategory',
                            'Đổi trạng thái danh mục' => 'changec',
                            'Xem danh sách đơn hàng' => 'order',
                            'Thêm đơn hàng' => 'orderadd',
                            'Chi tiết đơn hàng' => 'orderview',
                            'Thay đổi trạng thái đơn hàng' => 'changeorder',
                            'Xoá đơn hàng' => 'deleteorder',
                            'Xem danh sách thương hiệu' => 'brand',
                            'Thêm thương hiệu' => 'addbrand',
                            'Sửa thương hiệu' => 'editbrand',
                            'Xoá thương hiệu' => 'deletebrand',
                            'Đổi trạng thái thương hiệu' => 'changeBrand',
                            'Kết nối sản phẩm liên quan' => 'related',
                        ),

        );
    }


}













