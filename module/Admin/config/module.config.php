<?php
return [
    'service_manager' => [
        'factories' => [
            \Admin\V1\Rest\University\UniversityResource::class => \Admin\V1\Rest\University\UniversityResourceFactory::class,
            \Admin\V1\Rest\Etablissement\EtablissementResource::class => \Admin\V1\Rest\Etablissement\EtablissementResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin.rest.university' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/university[/:university_id]',
                    'defaults' => [
                        'controller' => 'Admin\\V1\\Rest\\University\\Controller',
                    ],
                ],
            ],
            'admin.rest.etablissement' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/etablissement[/:etablissement_id]',
                    'defaults' => [
                        'controller' => 'Admin\\V1\\Rest\\Etablissement\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'admin.rest.university',
            1 => 'admin.rest.etablissement',
        ],
    ],
    'api-tools-rest' => [
        'Admin\\V1\\Rest\\University\\Controller' => [
            'listener' => \Admin\V1\Rest\University\UniversityResource::class,
            'route_name' => 'admin.rest.university',
            'route_identifier_name' => 'university_id',
            'collection_name' => 'university',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'PATCH',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Admin\V1\Rest\University\UniversityEntity::class,
            'collection_class' => \Admin\V1\Rest\University\UniversityCollection::class,
            'service_name' => 'university',
        ],
        'Admin\\V1\\Rest\\Etablissement\\Controller' => [
            'listener' => \Admin\V1\Rest\Etablissement\EtablissementResource::class,
            'route_name' => 'admin.rest.etablissement',
            'route_identifier_name' => 'etablissement_id',
            'collection_name' => 'etablissement',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
                4 => 'POST',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
                3 => 'PATCH',
                4 => 'PUT',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Admin\V1\Rest\Etablissement\EtablissementEntity::class,
            'collection_class' => \Admin\V1\Rest\Etablissement\EtablissementCollection::class,
            'service_name' => 'etablissement',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Admin\\V1\\Rest\\University\\Controller' => 'HalJson',
            'Admin\\V1\\Rest\\Etablissement\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Admin\\V1\\Rest\\University\\Controller' => [
                0 => 'application/vnd.admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Admin\\V1\\Rest\\Etablissement\\Controller' => [
                0 => 'application/vnd.admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Admin\\V1\\Rest\\University\\Controller' => [
                0 => 'application/vnd.admin.v1+json',
                1 => 'application/json',
            ],
            'Admin\\V1\\Rest\\Etablissement\\Controller' => [
                0 => 'application/vnd.admin.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Admin\V1\Rest\University\UniversityEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.university',
                'route_identifier_name' => 'university_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \Admin\V1\Rest\University\UniversityCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.university',
                'route_identifier_name' => 'university_id',
                'is_collection' => true,
            ],
            \Admin\V1\Rest\Etablissement\EtablissementEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.etablissement',
                'route_identifier_name' => 'etablissement_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Admin\V1\Rest\Etablissement\EtablissementCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.etablissement',
                'route_identifier_name' => 'etablissement_id',
                'is_collection' => true,
            ],
            'Admin\\Rest\\University\\UniversityEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.university',
                'route_identifier_name' => 'university_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            'Admin\\Rest\\University\\UniversityCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'admin.rest.university',
                'route_identifier_name' => 'university_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Admin\\V1\\Rest\\University\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'Admin\\V1\\Rest\\Etablissement\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Admin\\V1\\Rest\\University\\Controller' => [
            'input_filter' => 'Admin\\V1\\Rest\\University\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Admin\\V1\\Rest\\University\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'univname',
                'description' => 'name of university',
                'error_message' => 'university name is not correct',
            ],
        ],
    ],
];
