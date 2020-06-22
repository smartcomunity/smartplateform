<?php
return [
    'controllers' => [
        'invokables' => [],
        'factories' => [
            \SetupParameters\Controller\MetaCursusController::class => \SetupParameters\Controller\MetaCursusControllerFactory::class,
            \SetupParameters\Controller\UsersController::class => \SetupParameters\Controller\UsersControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layout' => 'C:\\xampp\\htdocs\\smartplateform\\module\\SetupParameters/../../layouts/adminlte3/layout/layout.phtml',
        ],
        'template_path_stack' => [
            0 => 'C:\\xampp\\htdocs\\smartplateform\\module\\SetupParameters/view',
        ],
    ],
    'translator' => [
        'locale' => 'fr_FR',
        'translation_file_patterns' => [
            0 => [
                'type' => 'phpArray',
                'base_dir' => 'C:\\xampp\\htdocs\\smartplateform\\module\\SetupParameters\\config/../language',
                'pattern' => '%s.php',
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            0 => [
                0 => [
                    'label' => 'Home',
                    'route' => 'setup',
                ],
                1 => [
                    'label' => 'Gestion utilisateur',
                    'route' => 'setup/users/index',
                    'pages' => [
                        0 => [
                            'label' => 'Ajouter utilisateur',
                            'route' => 'setup/users/add-user',
                        ],
                    ],
                ],
                2 => [
                    'label' => 'Cursus',
                    'route' => 'setup/cursus/index',
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusResource::class => \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusResourceFactory::class,
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
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/setup',
                    'defaults' => [
                        'controller' => \SetupParameters\Controller\MetaCursusController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'cursus' => [
                        'type' => \Laminas\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/cursus',
                            'defaults' => [
                                'controller' => \SetupParameters\Controller\MetaCursusController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'actions-cursus' => [
                                'type' => \Laminas\Router\Http\Segment::class,
                                'options' => [
                                    'route' => '/:action[/:id]',
                                    'controller' => \SetupParameters\Controller\MetaCursusController::class,
                                    'constraints' => [
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id' => '[0-9_-]*',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'users' => [
                        'type' => \Laminas\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/users',
                            'defaults' => [
                                'controller' => \SetupParameters\Controller\UsersController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'actions-users' => [
                                'type' => \Laminas\Router\Http\Segment::class,
                                'options' => [
                                    'route' => '/:action[/:id]',
                                    'controller' => \SetupParameters\Controller\UsersController::class,
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
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SetupParameters\V1\Rest\SrvMetaCursus\SrvMetaCursusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'setup-parameters.rest.srv-meta-cursus',
                'route_identifier_name' => 'srv_meta_cursus_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Controller' => [
            'input_filter' => 'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'SetupParameters\\V1\\Rest\\SrvMetaCursus\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => 'Context id',
                'error_message' => 'Context id  empty',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'labelMetaContext',
                'description' => 'label MetaContext',
                'error_message' => 'label MetaContext empty',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'DescMetaContext',
                'description' => 'MetaContext description',
                'error_message' => 'MetaContext description is empty',
            ],
        ],
    ],
];
