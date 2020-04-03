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
 * UsersControllerFactory
 *
 * Creates an instance of UsersController
 *
 * @package Enseignant\Controller
 */
class UsersControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
         
        return new UsersController($container);
    }

    public function createService(ServiceLocatorInterface  $services)
    {
 
        return $this($services, UsersController::class);
    }
    
}
