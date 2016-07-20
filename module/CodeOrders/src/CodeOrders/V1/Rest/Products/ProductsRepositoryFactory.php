<?php

namespace CodeOrders\V1\Rest\Products;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsRepositoryFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $hydrator = new HydratingResultSet(new \Zend\Stdlib\Hydrator\ClassMethods(), new ProductsEntity());
        $tableGateway = new TableGateway('products', $dbAdapter, null, $hydrator);

        return new ProductsRepository($tableGateway);
    }
}
