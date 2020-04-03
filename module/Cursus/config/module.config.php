<?php
namespace Cursus;

return [
    'view_manager' => [
        'template_map' => include CURSUS_MODULE_ROOT . '/template_map.php',
        'template_path_stack' => [
            CURSUS_MODULE_ROOT . '/view',
        ],
    ],
    'router' => [
        'routes' => [
            'cursus' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/cursus/metaworker',
                    'defaults' => [
                        '__NAMESPACE__' => 'Cursus',
                        'controller' => Controller\MetaworkerController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'controller-action' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/:controller[/:action[/:id/[:id2]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9A-Za-z_-]*',
                                'id2' => '[0-9A-Za-z_-]*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            Controller\MetaworkerController::class => Controller\MetaworkerController::class,
        ],
    ],
    // ... other configuration ...
];