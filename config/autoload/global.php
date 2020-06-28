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
        
        'adapters' => [
            'smarteducation2' => ['driver' => \pdo::class,
            'dsn' => 'mysql:dbname=smarteducation2;host=localhost;charset=utf8;port=3306',
            'user' => 'root',
            'pass' => '',
            'driver_options' => [
                1002 => 'SET NAMES \'UTF8\'',
            ],],
            'data' => ['driver' => \pdo::class,
            'dsn' => 'mysql:dbname=data;host=localhost;charset=utf8;port=3306',
            'user' => 'root',
            'pass' => '',
            'driver_options' => [
                1002 => 'SET NAMES \'UTF8\'',
            ],],
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
