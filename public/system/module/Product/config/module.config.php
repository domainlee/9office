<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Product\Controller\Product' => 'Product\Controller\ProductController',
        	'Product\Controller\Wishlist' => 'Product\Controller\WishlistController',
        ),
    ),
    'router' => array(
        'routes' => array(
//        	'product' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route'    => '[/:locale]/san-pham.html',
//                    'constraints' => [
//                        'locale' => '[a-z]{2}-[a-z]{2}'
//                    ],
//                    'defaults' => array(
//                    	'__NAMESPACE__' => 'Product\Controller',
//                        'controller' => 'Product\Controller\Product',
//                        'action'     => 'index',
//                    ),
//                ),
//                'may_terminate' => true,
//                'child_routes' => array (
//		            'default' => array(
//		                'type'    => 'segment',
//		                'options' => array(
//		                    'route'    => '[/:action]',
//		                    'constraints' => array(
//		                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//		                    ),
//		                    'defaults' => array(
//		                    	'__NAMESPACE__' => 'Product\Controller',
//		                        'controller' => 'Product\Controller\Product',
//		                        'action'     => 'index',
//		                    ),
//		                ),
//		            ),
//				)
//        	),
//            'products' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/san-pham.html',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Product\Controller',
//                        'controller' => 'Product\Controller\Product',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
            'viewProduct' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:name].html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Product\Controller',
                        'controller' => 'Product\Controller\Product',
                        'action'     => 'viewall',
                    ),
                ),
            ),
            'viewProduct2' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:name]-p[:id].html',
                    'constraints' => array (
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Product\Controller',
                        'controller' => 'Product\Controller\Product',
                        'action'     => 'view',
                    ),
                ),
            ),
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/[:name]-pc[:id].html',
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
                    'defaults'    => array(
                        '__NAMESPACE__' => 'Product\Controller',
                        'controller'    => 'Product\Controller\Product',
                        'action'        => 'category',
                    ),
                ),
            ),
            'page' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:name]-pa[:id].html',
                    'constraints' => array (
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Page',
                        'action'     => 'index',
                    ),
                ),
            ),
            'register' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/register[-:name].html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'register',
                    ),
                ),
            ),
			'wishlist' => array(
					'type' => 'Literal',
					'options' => array (
							'route' => '/wishlist',
							'defaults' => array(
									'__NAMESPACE__' => 'Product\Controller',
									'controller' => 'Product\Controller\Wishlist',
									'action'     => 'index',
							),
					),
					'may_terminate' => true,
					'child_routes' => array(
						'add' => array(
								'type' => 'Literal',
								'options' => array(
									'route' => '/add',
									'defaults' => array(
											'__NAMESPACE__' => 'Product\Controller',
											'controller' => 'Wishlist',
											'action' => 'add'
									),
							),
					),
					'remove' => array(
							'type' => 'Literal',
							'options' => array(
									'route' => '/remove',
									'defaults' => array(
											'__NAMESPACE__' => 'Product\Controller',
											'controller' => 'Wishlist',
											'action' => 'remove'
									),
							),
					),
				)
			)
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'product' => __DIR__ . '/../view',
        ),
    ),
);