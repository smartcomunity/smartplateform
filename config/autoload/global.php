<?php
return [
    'service_manager' => [
        'factories' => [
            \Laminas\Db\Adapter\Adapter::class => \Laminas\Db\Adapter\AdapterServiceFactory::class,
        ],
    ],
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'driver' => \pdo::class,
        'dsn' => 'mysql:dbname=smarteducation;host=localhost;charset=utf8;port=3306',
        'user' => 'root',
        'pass' => '',
        'driver_options' => [
            1002 => 'SET NAMES \'UTF8\'',
        ],
        'adapters' => [
            'smarteducation' => [],
        ],
    ],
    'router' => [
        'routes' => [
            'oauth' => [
                'options' => [
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ],
                'type' => 'regex',
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'map' => [
                'Admin\\V1' => 'smarteducation',
            ],
        ],
    ],
];
