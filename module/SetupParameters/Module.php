<?php

namespace SetupParameters;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
 

class Module implements ApiToolsProviderInterface
{

    public function init(ModuleManagerInterface $manager)
    {
        if (!defined('SETUP_PARAMETERS_MODULE_ROOT')) {
            define('SETUP_PARAMETERS_MODULE_ROOT', realpath(__DIR__));
        }
    }

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
                ],
            ],
          /*  'Laminas\\Loader\\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    'SetupParameters\Navigator\Service' => __DIR__ . '/navigator/service',
                ),
            ),*/
        ];
    }

     /**
     * Config service
     */
  /*  public function getServiceConfig() {
        return array(
            'factories' => array(
                'DB\Adapter' => function($sm) {
                    $dbAdapter = $sm->get(\Laminas\Db\Adapter\AdapterInterface::class);
                    return $dbAdapter;
                },

            ),
        );
    }*/
}
