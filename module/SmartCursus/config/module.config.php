<?php
return [
    'service_manager' => [
        'factories' => [
            \SmartCursus\V1\Rest\Metacontext\MetacontextResource::class => \SmartCursus\V1\Rest\Metacontext\MetacontextResourceFactory::class,
            \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusResource::class => \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusResourceFactory::class,
            \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessResource::class => \SmartCursus\V1\Rest\Elementmetaprocess\ElementmetaprocessResourceFactory::class,
            \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsResource::class => \SmartCursus\V1\Rest\Elementmetapassruls\ElementmetapassrulsResourceFactory::class,
            \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerResource::class => \SmartCursus\V1\Rest\Metamodelsworker\MetamodelsworkerResourceFactory::class,
            \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessResource::class => \SmartCursus\V1\Rest\Linkedprocess\LinkedprocessResourceFactory::class,
            \SmartCursus\V1\Rest\LastElement\LastElementResource::class => \SmartCursus\V1\Rest\LastElement\LastElementResourceFactory::class,
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
            'smart-cursus.rest.elementmetacursus' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/elementmetacursus[/:elementmetacursus_id]',
                    'defaults' => [
                        'controller' => 'SmartCursus\\V1\\Rest\\Elementmetacursus\\Controller',
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
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'smart-cursus.rest.metacontext',
            1 => 'smart-cursus.rest.elementmetacursus',
            2 => 'smart-cursus.rest.elementmetaprocess',
            3 => 'smart-cursus.rest.elementmetapassruls',
            4 => 'smart-cursus.rest.metamodelsworker',
            5 => 'smart-cursus.rest.linkedprocess',
            7 => 'smart-cursus.rest.last-element',
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
        'SmartCursus\\V1\\Rest\\Elementmetacursus\\Controller' => [
            'listener' => \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusResource::class,
            'route_name' => 'smart-cursus.rest.elementmetacursus',
            'route_identifier_name' => 'elementmetacursus_id',
            'collection_name' => 'elementmetacursus',
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
            'entity_class' => \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusEntity::class,
            'collection_class' => \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusCollection::class,
            'service_name' => 'Elementmetacursus',
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
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => 'Json',
            'SmartCursus\\V1\\Rest\\Elementmetacursus\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Elementmetaprocess\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Elementmetapassruls\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Metamodelsworker\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\Linkedprocess\\Controller' => 'HalJson',
            'SmartCursus\\V1\\Rest\\LastElement\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetacursus\\Controller' => [
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
        ],
        'content_type_whitelist' => [
            'SmartCursus\\V1\\Rest\\Metacontext\\Controller' => [
                0 => 'application/vnd.smart-cursus.v1+json',
                1 => 'application/json',
            ],
            'SmartCursus\\V1\\Rest\\Elementmetacursus\\Controller' => [
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
            \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetacursus',
                'route_identifier_name' => 'elementmetacursus_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SmartCursus\V1\Rest\Elementmetacursus\ElementmetacursusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'smart-cursus.rest.elementmetacursus',
                'route_identifier_name' => 'elementmetacursus_id',
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
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
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
        ],
    ],
];
