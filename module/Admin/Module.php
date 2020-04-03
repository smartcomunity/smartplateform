<?php
namespace Admin;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;

class Module implements ApiToolsProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                    'Models\Smarteducation' => __DIR__ . '/../../models/Smarteducation',
                    'Models\ExSmarteducation' => __DIR__ . '/../../models/ExSmarteducation',
                ],
            ],
        ];
    }
    public function getServiceConfig() {
        return array(
            'factories' => array(
                    'DB\Adapter' => function($sm) {
                        $dbAdapter = $sm->get('Laminas\Db\Adapter\Adapter');
                        return $dbAdapter;
                    },    
                ),
            );
    }
}
