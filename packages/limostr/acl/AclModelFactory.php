<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 18/04/2018
 * Time: 16:04
 */

namespace Myhelper\Acl;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorAwareInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;


class AclModelFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface|ServiceLocatorAwareInterface $ServiceNameManager
     * @return AclModelFactory
     */
    public function createService(ServiceLocatorInterface $ServiceNameManager)
    {
        $serviceLocator = $ServiceNameManager->getServiceLocator();

        $instance = new AclModel();

        return $instance;
    }
}