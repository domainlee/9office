<?php
return [
    'controllers'  => [
        'invokables' => [
            'News\Controller\News' => 'News\Controller\NewsController',
        ],
    ],
    'router'       => [
        'routes' => [
            'news'             => [
                'type'          => 'Segment',
                'options'       => [
                    'route'       => '[/:locale]/bai-viet.html',
                    'constraints' => [
                        'locale' => '[a-z]{2}-[a-z]{2}'
                    ],
                    'defaults'    => [
                        '__NAMESPACE__' => 'News\Controller',
                        'controller'    => 'News\Controller\News',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'default'   => [
                        'type'    => 'segment',
                        'options' => [
                            'route'       => '[/:action]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults'    => [
                                '__NAMESPACE__' => 'News\Controller',
                                'controller'    => 'News\Controller\News',
                                'action'        => 'index',
                            ],
                        ],
                    ],
                ]
            ],
            'categoryNews'  => [
                'type'    => 'segment',
                'options' => [
                    'route' => '/[:name]-nc[:id].html',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults'    => [
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'category',
                    ],
                ],
            ],
            'view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:name]-n[:id].html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'view',
                    ),
                ),
            ),
            'demo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/demo/[:name]-n[:id].html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'demo',
                    ),
                ),
            ),
//            'viewUrl' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/[:name]-n[:id].html',
//                    'constraints' => array(
//                        'id' => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'News\Controller',
//                        'controller' => 'News\Controller\News',
//                        'action'     => 'view',
//                    ),
//                ),
//            ),
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog.html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'blog',
                    ),
                ),
            ),
            'price' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/bang-gia.html',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'price',
                    ),
                ),
            ),
            'products' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/san-pham.html',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Product\Controller',
                        'controller' => 'Product\Controller\Product',
                        'action'     => 'index',
                    ),
                ),
            ),
            'theme' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/kho-giao-dien.html',
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller' => 'News\Controller\News',
                        'action'     => 'theme',
                    ),
                ),
            ),
            'tags'             => [
                'type'          => 'Segment',
                'options'       => [
                    'route'       => '/bai-viet.html?tag=[:tags]',
                    'constraints' => [
                        'tags' => '[a-z]{2}-[a-z]{2}'
                    ],
                    'defaults'    => [
                        '__NAMESPACE__' => 'News\Controller',
                        'controller'    => 'News\Controller\News',
                        'action'        => 'index',
                    ],
                ],
            ],
            'contact' => array (
                'type' => 'segment',
                'options' => array (
                    'route' => '/lien-he.html',
                    'defaults' => array (
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home\Controller\Contact',
                        'action'     => 'contact',
                    ),
                ),
            ),
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'news' => __DIR__ . '/../view',
        ],
    ],
];