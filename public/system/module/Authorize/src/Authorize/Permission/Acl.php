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
        $this->addResource('admin:material');
        $this->addResource('admin:invoice');
        $this->addResource('admin:manufacture');


        $this->addResource('payment:baokim');

		$this->allow('Guest', 'home:index',array('index','landing' , 'search','register', 'registerajax', 'active', 'rating', 'comment', 'listcomment', 'createdstep'));
        $this->allow('Guest', 'home:contact',array('index', 'contact', 'contactajax'));
        $this->allow('Guest', 'home:search',array('index'));
        $this->allow('Guest', 'home:page',array('index'));

        $this->allow('Guest', 'home:layout', array('index', 'suggestion'));
		//$this->allow('Guest', 'admin:admin',array('index'));
		$this->allow('Guest', 'user:user', array('signin', 'signout', 'signup', 'profile', 'getactivecode', 'getpassword','active', 'changepassword', 'token', 'datafacebook', 'checkemail'));
		$this->allow('Guest', 'payment:baokim', array('bpn'));
		$this->allow('Guest', 'pro:pro', array('index'));
		$this->allow('Guest', 'product:product', array('index','view','category','child', 'viewall'));
		$this->allow('Guest', 'article:article', array('index','view','category'));
        $this->allow('Guest', 'news:news', array('index','view','category','tag','blog', 'blogview', 'price','theme', 'demo'));

//        $this->allow('Guest', 'order:cart', array('index','add','remove'));
        $this->allow('Guest', 'order:cart', ['index', 'add', 'remove', 'checkout', 'cartsignin', 'quickAdd', 'addwaiting', 'change', 'success']);
        $this->allow('Guest', 'order:order', ['index', 'add', 'remove', 'checkout', 'cartsignin', 'quickAdd', 'addwaiting']);

        //member
        $this->allow('Admin', 'admin:admin', array('index', 'optionadmin'));
        $this->allow('Guest', 'admin:admin', array('huongdan'));
        $this->allow('Guest', 'admin:material', array('additemproduct', 'importmaterial', 'exportproduct', 'ordermanufacture'));
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
        return array(   'T??i kho???n' => array(
                            'Xem danh s??ch t??i kho???n' => 'index',
                            'Th??m t??i kho???n' => 'add',
                            'S???a t??i kho???n' => 'edit',
                            'Xo?? t??i kho???n' => 'delete',
                            '?????i tr???ng th??i t??i kho???n' => 'change',
//                            'Danh s??ch t??n mi???n' => 'domain',
//                            'Th??m website' => 'adddomain',
//                            'Xo?? website' => 'deletedomain',
//                            'Danh s??ch li??n h???' => 'contact',
//                            'Th??m kh??ch h??ng' => 'client',
                        ),
//                        'Trang' => array(
//                            'Xem danh s??ch trang' => 'index',
//                            'Th??m trang' => 'add',
//                            'S???a trang' => 'edit',
//                            'Xo?? trang' => 'delete',
//                            'Thay ?????i tr???ng th??i trang' => 'change',
//                            'Tu??? ch???nh trang' => 'homepage',
//                        ),
//                        'C??i ?????t' => array(
//                            'Tu??? ch???nh c??i ?????t' => 'index',
//                            'Qu???n l?? menu' => 'menu',
//                            'Th??m Script/CSS' => 'source',
//                            'Giao di???n trang ch???' => 'template',
//                            'C??i ?????t kh??c' => 'other',
//                            'Robot / XML' => 'robot',
//                            'Popup' => 'popup',
//                            '?????i giao di???n' => 'skin',
//                            'Danh s??ch b??nh lu???n' => 'comment',
//                        ),
                        'V???t li???u' => array(
                            'Danh s??ch v???t li???u' => 'index',
                            'T???o v???t li???u' => 'add',
                            'S???a v???t li???u' => 'edit',
                            'Danh s??ch s???n ph???m' => 'product',
                            'Th??m s???n ph???m' => 'addproduct',
                        ),
                        'Ho?? ????n' => array(
                            'Danh s??ch invoice' => 'index',
                            'T???o invoice' => 'add',
                            'Duy???t nh???p h??ng' => 'import',
                            'Duy???t xu???t h??ng' => 'export',
                        ),
                        '????n h??ng' => array(
                            'Xem danh s??ch ????n h??ng' => 'index',
                        ),
                        'Nh?? cung c???p' => array(
                            'Xem danh s??ch nh?? cung c???p' => 'index',
                        ),
//                        'Question' => array (
//                            'C??ng vi???c' => 'task',
//                        ),
//                        'S???n ph???m' => array(
//                            'B??n h??ng' => 'sale',
//                            'T???o ????n h??ng' => 'createorder',
//                            'Danh s??ch kh??ch h??ng' => 'client',
//                            'B??o c??o b??n h??ng' => 'reportsale',
//                            'Xem danh s??ch s???n ph???m' => 'index',
//                            'Th??m s???n ph???m' => 'add',
//                            'Th??m s???n ph???m file Excel' => 'importexcel',
//                            'S???a s???n ph???m' => 'edit',
//                            'Xo?? s???n ph???m' =>  'delete',
//                            '?????i tr???ng th??i s???n ph???m' =>  'change',
//                            'Danh s??ch thu???c t??nh' => 'attr',
//                            'Xo?? thu???c thu???c t??nh' => 'deleteattr',
//                            'Xem danh s??ch danh m???c' => 'category',
//                            'Th??m danh m???c' => 'addcategory',
//                            'S???a danh m???c' => 'editcategory',
//                            'Xo?? danh m???c' => 'deletecategory',
//                            '?????i tr???ng th??i danh m???c' => 'changec',
//                            'Xem danh s??ch ????n h??ng' => 'order',
//                            'Th??m ????n h??ng' => 'orderadd',
//                            'Chi ti???t ????n h??ng' => 'orderview',
//                            'Thay ?????i tr???ng th??i ????n h??ng' => 'changeorder',
//                            'Xo?? ????n h??ng' => 'deleteorder',
//                            'Xem danh s??ch th????ng hi???u' => 'brand',
//                            'Th??m th????ng hi???u' => 'addbrand',
//                            'S???a th????ng hi???u' => 'editbrand',
//                            'Xo?? th????ng hi???u' => 'deletebrand',
//                            '?????i tr???ng th??i th????ng hi???u' => 'changeBrand',
//                            'K???t n???i s???n ph???m li??n quan' => 'related',
//                        ),

        );
    }


}













