<?php

namespace CodeOrders\V1\Rest\Auth;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $identity = $serviceLocator->get('api-identity');
        $usersRepository = $serviceLocator->get('CodeOrders\\V1\\Rest\\Users\\UsersRepository');
        $user = $usersRepository->findByUsername($identity->getRoleId());

        return new AuthService($user);
    }
}
