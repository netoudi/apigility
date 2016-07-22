<?php

namespace CodeOrders\V1\Rest\Orders;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersRepositoryFactory implements FactoryInterface
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
        $hydrator = new HydratingResultSet(new ClassMethods(), new OrdersEntity());
        $tableGateway = new TableGateway('orders', $dbAdapter, null, $hydrator);
        $ordersItemsTableGateway = $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrdersItemsTableGateway');

        return new OrdersRepository($tableGateway, $ordersItemsTableGateway);
    }
}
