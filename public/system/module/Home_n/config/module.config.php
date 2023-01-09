<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Home\Controller\Index' => 'Home\Controller\IndexController',
            'Home\Controller\Search' => 'Home\Controller\SearchController',
            'Home\Controller\Loadview' => 'Home\Controller\LoadviewController',
            'Home\Controller\Contact' => 'Home\Controller\ContactController',
            'Home\Controller\Page' => 'Home\Controller\PageController'
        )
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Index',
                                'action' => 'index'
                            )
                        )
                    )
                )
            ),
            'homeAlias' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/home',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Index',
                                'action' => 'index'
                            )
                        )
                    )
                )
            ),
            // Search router
            'search' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/search',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Search',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'suggestion' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/suggestion',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Home\Controller',
                                'controller' => 'Search',
                                'action' => 'suggestion'
                            )
                        )
                    ),
                    'noresult' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/noresult',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Home\Controller',
                                'controller' => 'Search',
                                'action' => 'noresult'
                            )
                        )
                    ),
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action]',
                            'constraints' => array(
                                '__NAMESPACE__' => 'Home\Controller',
                                'controller' => 'Search',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
            // Loadview router
            'loadview' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/loadview',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Loadview',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action]',
                            'constraints' => array(
                                '__NAMESPACE__' => 'Home\Controller',
                                'controller' => 'Home\Controller\Loadview',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            ),
//            'contact' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/lien-he.html',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Home\Controller',
//                        'controller' => 'Home\Controller\Contact',
//                        'action'     => 'contact',
//                    ),
//                ),
//            ),
            'contactajax' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/contactajax',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Contact',
                        'action'     => 'contactajax',
                    ),
                ),
            ),
//            'page' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/[:name]-pa[:id].html',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Home\Controller',
//                        'controller' => 'Home\Controller\Page',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
//            'register' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/register[-:name].html',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Home\Controller',
//                        'controller' => 'Home\Controller\Index',
//                        'action'     => 'register',
//                    ),
//                ),
//            ),
            'active' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/active[/:name]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'active',
                    ),
                ),
            ),
            'registerajax' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/registerajax',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'registerajax',
                    ),
                ),
            ),
            'createdstep' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/created',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'createdstep',
                    ),
                ),
            ),
            'landing' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/landing',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'landing',
                    ),
                ),
            ),
            'huongdan' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/huongdan',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'huongdan',
                    ),
                ),
            ),
            'rating' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/rating',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'rating',
                    ),
                ),
            ),
            'comment' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/comment',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'comment',
                    ),
                ),
            ),
            'listcomment' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/listcomment',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'listcomment',
                    ),
                ),
            ),
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory'
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'template_map' => array(
            'empty' => __DIR__ . '/../view/layout/emptylayout.phtml',
            'site/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
        ),
    	'exception_template' => 'error/index',
    	'not_found_template' => 'error/404',

        'strategies' => array(
            'ViewJsonStrategy'
        ),
    ),


);