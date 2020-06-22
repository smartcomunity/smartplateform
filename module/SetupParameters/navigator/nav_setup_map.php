<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: username
 * Date: 24/01/2017
 * Time: 12:26
 */


 return  [
                [
                'label' => 'Home',
                'route' => 'setup',
                ],
                [
                    'label' => 'Gestion utilisateur',
                    'route' => 'setup/users/index',
                    'pages' => [
                        [
                            'label' => 'Ajouter utilisateur',
                            'route' => 'setup/users/add-user',
                        ],
                    ],
                ],
                [
                    'label' => 'Cursus',
                    'route' => 'setup/cursus/index',
                ]
];
