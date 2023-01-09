<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User' => 'User\Controller\UserController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'user' => array (
				'type' => 'Literal',
				'options' => array (
					'route' => '/user',
					'defaults' => array (
						'__NAMESPACE__' => 'User\Controller',
						'controller' => 'User\Controller\User',
						'action' => 'index'
					)
				),
				'may_terminate' => true,
				'child_routes' => array (
					'default' => array (
						'type' => 'segment',
						'options' => array (
							'route' => '[/:controller][/:action][/:id]',
							'constraints' => array (
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'id' => '[0-9]*'
							)
						)
					),
					'signin' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/signin',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'signin',
                            ),
                        ),
                    ),
                    'signout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/signout',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'signout',
                            ),
                        ),
                    ),
                    'signup' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/signup',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'signup',
                            ),
                        ),
                    ),
					'profile' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/profile',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'profile',
                            ),
                        ),
                    ),
                    'add' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                    'active' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/active',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'active',
                            ),
                        ),
                    ),
                    'datafacebook' => array(
                        'type' => 'Literal',
                        'options' => array (
                            'route' => '/fb',
//                            'constraints' => array (
//                                'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'datafacebook',
                            ),
                        ),
                    ),
                    'checkmail' => array(
                        'type' => 'Literal',
                        'options' => array (
                            'route' => '/checkemail',
//                            'constraints' => array (
//                                'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'checkemail',
                            ),
                        ),
                    ),
                    'changepassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/changepassword',
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'changepassword',
                            ),
                        ),
                    ),
                    'token' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/token',
//                            'constraints' => array (
//                                'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
                            'defaults' => array(
                                'controller' => 'User\Controller\User',
                                'action'     => 'token',
                            ),
                        ),
                    ),
                	
                		
                   ),
        		),
        	),
    	),
		'view_manager' => array(
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
		
);