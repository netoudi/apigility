<?php

namespace CodeOrders\V1\Rest\Users;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsersServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UsersService($serviceLocator->get('CodeOrders\\V1\\Rest\\Users\\UsersRepository'));
    }
}
