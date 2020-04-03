<?php
namespace Cursus;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;

class Module implements ApiToolsProviderInterface
{
    public function init(ModuleManagerInterface $manager)
    {
        if (!defined('CURSUS_MODULE_ROOT')) {
            define('CURSUS_MODULE_ROOT', realpath(__DIR__));
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
        ];
    }
}
