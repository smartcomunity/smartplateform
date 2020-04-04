<?php

namespace SetupParameters;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
return [
    'controllers' => [
        'invokables' => [
           //Controller\MetaCursusController::class => Controller\MetaCursusController::class,
        ],
        'factories' => [
            Controller\MetaCursusController::class => Controller\MetaCursusControllerFactory::class,
            Controller\UsersController::class => Controller\UsersControllerFactory::class,

        ],
    ],

    'view_manager' => [
        'template_map' => include SETUP_PARAMETERS_MODULE_ROOT . '/template_map.php',
        'template_path_stack' => [
            SETUP_PARAMETERS_MODULE_ROOT . '/view',
        ],
    ],

    'translator' => [
        'locale' => 'fr_FR',
        'translation_file_patterns' => [
            [
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.php',
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            include __DIR__ . '/../navigator/nav_setup_map.php',
        ],
       
    ],
    'service_manager' => [
        'factories' => [
            \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusResource::class => \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusResourceFactory::class,
           //   'navigation' => \Laminas\Navigation\Service\DefaultNavigationFactory::class,
       //     'SetupParameters_Navigator' =>  \SetupParameters\Navigator\Service\SetupParametersNavigationFactory::class,
 
        ],
          
    ], 
    'router' => [
        'routes' => [
            'setup-parameters.rest.srv-meta-cursus' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/srv-meta-cursus[/:srv_meta_cursus_id]',
                    'defaults' => [
                        'controller' => 'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller',
                    ],
                ],
            ],
            'setup' => [
                'type' =>  Literal::class ,
                'options' => [
                    'route' => '/setup',
                    'defaults' => [ 
                        'controller' => Controller\MetaCursusController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'cursus' => [
                        'type' =>  Literal::class ,
                        'options' => [
                            'route' => '/cursus',
                            'defaults' => [ 
                                'controller' => Controller\MetaCursusController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'actions-cursus' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/:action[/:id]',
                                    'controller' => Controller\MetaCursusController::class,
                                    'constraints' => [ 
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id' => '[0-9_-]*',
                                    ],
                                ],
                            ], 
                        ],
                    ], 
                    'users' => [
                        'type' =>  Literal::class ,
                        'options' => [
                            'route' => '/users',
                            'defaults' => [ 
                                'controller' => Controller\UsersController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'actions-users' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/:action[/:id]',
                                    'controller' => Controller\UsersController::class,
                                    'constraints' => [ 
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id' => '[0-9_-]*',
                                    ],
                                ],
                            ], 
                        ],
                    ],
                ],
            ],
            
       
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'setup-parameters.rest.srv-meta-cursus',
        ],
    ],
    'api-tools-rest' => [
        'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller' => [
            'listener' => \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusResource::class,
            'route_name' => 'setup-parameters.rest.srv-meta-cursus',
            'route_identifier_name' => 'srv_meta_cursus_id',
            'collection_name' => 'srv_meta_cursus',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusEntity::class,
            'collection_class' => \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusCollection::class,
            'service_name' => 'SrvMetaCursus',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller' => [
                0 => 'application/vnd.setup-parameters.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller' => [
                0 => 'application/vnd.setup-parameters.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'setup-parameters.rest.srv-meta-cursus',
                'route_identifier_name' => 'srv_meta_cursus_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'setup-parameters.rest.srv-meta-cursus',
                'route_identifier_name' => 'srv_meta_cursus_id',
                'is_collection' => true,
            ],
        ],
    ],
];
