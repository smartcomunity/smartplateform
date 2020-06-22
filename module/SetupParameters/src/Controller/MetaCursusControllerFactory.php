<?php
/**
 * ZF2 Application built by ZF2rapid
 *
 * @copyright (c) 2015 John Doe
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */


namespace SetupParameters\Controller;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;
 
/**
 * MetaCursusControllerFactory
 *
 * Creates an instance of MetaCursusController
 *
 * @package Enseignant\Controller
 */
class MetaCursusControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
         
        return new MetaCursusController($container);
    }

    public function createService(ServiceLocatorInterface  $services)
    {
 
        return $this($services, MetaCursusController::class);
    }
    
}
