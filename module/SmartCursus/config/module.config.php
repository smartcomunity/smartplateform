<?php
return [
    'service_manager' => [
        'factories' => [
            \SmartCursus\V1\Rest\Metacontext\MetacontextResource::class => \SmartCursus\V1\Rest\Metacontext\MetacontextResourceFactory::class,
            \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessResource::class => \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessResourceFactory::class,
            \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsResource::class => \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsResourceFactory::class,
            \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerResource::class => \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerResourceFactory::class,
            \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessResource::class => \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessResourceFactory::class,
            \SmartCursus\V1\Rest\LastElement\LastElementResource::class => \SmartCursus\V1\Rest\LastElement\LastElementResourceFactory::class,
            \SmartCursus\V1\Rest\RevokeToken\RevokeTokenResource::class => \SmartCursus\V1\Rest\RevokeToken\RevokeTokenResourceFactory::class,
            \SmartCursus\V1\Rest\User\UserResource::class => \SmartCursus\V1\Rest\User\UserResourceFactory::class,
            \SmartCursus\V1\Rest\UserType\UserTypeResource::class => \SmartCursus\V1\Rest\UserType\UserTypeResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'smart-cursus.rest.metacontext' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/metacontext[/:metacontext_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Metacontext\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.elementmetaprocess' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/elementmetaprocess[/:elementmetaprocess_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.elementmetapassruls' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/elementmetapassruls[/:elementmetapassruls_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.metamodelsworker' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/metamodelsworker[/:metamodelsworker_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.linkedprocess' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/linkedprocess[/:linkedprocess_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.last-element' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/last-element[/:last_element_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\LastElement\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.revoke-token' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/revoke-token[/:revoke_token_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\RevokeToken\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\User\\Controller',
                    ],
                ],
            ],
            'smart-cursus.rest.user-type' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user-type[/:user_type_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\UserType\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'smart-cursus.rest.metacontext',
            2 => 'smart-cursus.rest.elementmetaprocess',
            3 => 'smart-cursus.rest.elementmetapassruls',
            4 => 'smart-cursus.rest.metamodelsworker',
            5 => 'smart-cursus.rest.linkedprocess',
            7 => 'smart-cursus.rest.last-element',
            9 => 'smart-cursus.rest.revoke-token',
            10 => 'smart-cursus.rest.user',
            11 => 'smart-cursus.rest.user-type',
        ],
    ],
    'api-tools-rest' => [
        'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Metacontext\MetacontextResource::class,
            'route_name' => 'smart-cursus.rest.metacontext',
            'route_identifier_name' => 'metacontext_id',
            'collection_name' => 'metacontext',
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
            'entity_class' => \SmartCursus\V1\Rest\Metacontext\MetacontextEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Metacontext\MetacontextCollection::class,
            'service_name' => 'Metacontext',
        ],
        'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessResource::class,
            'route_name' => 'smart-cursus.rest.elementmetaprocess',
            'route_identifier_name' => 'elementmetaprocess_id',
            'collection_name' => 'elementmetaprocess',
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
            'entity_class' => \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessCollection::class,
            'service_name' => 'Elementmetaprocess',
        ],
        'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsResource::class,
            'route_name' => 'smart-cursus.rest.elementmetapassruls',
            'route_identifier_name' => 'elementmetapassruls_id',
            'collection_name' => 'elementmetapassruls',
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
            'entity_class' => \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsCollection::class,
            'service_name' => 'Elementmetapassruls',
        ],
        'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerResource::class,
            'route_name' => 'smart-cursus.rest.metamodelsworker',
            'route_identifier_name' => 'metamodelsworker_id',
            'collection_name' => 'metamodelsworker',
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
            'entity_class' => \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerCollection::class,
            'service_name' => 'Metamodelsworker',
        ],
        'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessResource::class,
            'route_name' => 'smart-cursus.rest.linkedprocess',
            'route_identifier_name' => 'linkedprocess_id',
            'collection_name' => 'linkedprocess',
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
            'entity_class' => \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessCollection::class,
            'service_name' => 'linkedprocess',
        ],
        'SmartCursus\\V1\\Rest\\LastElement\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\LastElement\LastElementResource::class,
            'route_name' => 'smart-cursus.rest.last-element',
            'route_identifier_name' => 'last_element_id',
            'collection_name' => 'last_element',
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
            'entity_class' => \SmartCursus\V1\Rest\LastElement\LastElementEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\LastElement\LastElementCollection::class,
            'service_name' => 'LastElement',
        ],
        'SmartCursus\\V1\\Rest\\RevokeToken\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\RevokeToken\RevokeTokenResource::class,
            'route_name' => 'smart-cursus.rest.revoke-token',
            'route_identifier_name' => 'revoke_token_id',
            'collection_name' => 'revoke_token',
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
            'entity_class' => \SmartCursus\V1\Rest\RevokeToken\RevokeTokenEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\RevokeToken\RevokeTokenCollection::class,
            'service_name' => 'RevokeToken',
        ],
        'SmartCursus\\V1\\Rest\\User\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\User\UserResource::class,
            'route_name' => 'smart-cursus.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
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
            'entity_class' => \SmartCursus\V1\Rest\User\UserEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\User\UserCollection::class,
            'service_name' => 'User',
        ],
        'SmartCursus\\V1\\Rest\\UserType\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\UserType\UserTypeResource::class,
            'route_name' => 'smart-cursus.rest.user-type',
            'route_identifier_name' => 'user_type_id',
            'collection_name' => 'user_type',
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
            'entity_class' => \SmartCursus\V1\Rest\UserType\UserTypeEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\UserType\UserTypeCollection::class,
            'service_name' => 'UserType',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => 'Json',
            'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\LastElement\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\RevokeToken\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\User\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\UserType\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\LastElement\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\RevokeToken\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\UserType\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\LastElement\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\RevokeToken\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\UserType\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \SmartCursus\V1\Rest\Metacontext\MetacontextEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.metacontext',
                'route_identifier_name' => 'metacontext_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Metacontext\MetacontextCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.metacontext',
                'route_identifier_name' => 'metacontext_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetaprocess',
                'route_identifier_name' => 'elementmetaprocess_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetaprocess',
                'route_identifier_name' => 'elementmetaprocess_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetapassruls',
                'route_identifier_name' => 'elementmetapassruls_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetapassruls',
                'route_identifier_name' => 'elementmetapassruls_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.metamodelsworker',
                'route_identifier_name' => 'metamodelsworker_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.metamodelsworker',
                'route_identifier_name' => 'metamodelsworker_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.linkedprocess',
                'route_identifier_name' => 'linkedprocess_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.linkedprocess',
                'route_identifier_name' => 'linkedprocess_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\LastElement\LastElementEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.last-element',
                'route_identifier_name' => 'last_element_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\LastElement\LastElementCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.last-element',
                'route_identifier_name' => 'last_element_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\RevokeToken\RevokeTokenEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.revoke-token',
                'route_identifier_name' => 'revoke_token_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\RevokeToken\RevokeTokenCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.revoke-token',
                'route_identifier_name' => 'revoke_token_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\User\UserEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\User\UserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \SmartCursus\V1\Rest\UserType\UserTypeEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.user-type',
                'route_identifier_name' => 'user_type_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\UserType\UserTypeCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.user-type',
                'route_identifier_name' => 'user_type_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
            'SmartCursus\\V1\\Rest\\User\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];
