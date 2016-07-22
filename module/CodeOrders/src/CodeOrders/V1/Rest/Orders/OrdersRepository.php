<?php

namespace CodeOrders\V1\Rest\Orders;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $orderTable;
    /**
     * @var TableGatewayInterface
     */
    private $itemTable;

    /**
     * OrdersRepository constructor.
     * @param TableGatewayInterface $orderTable
     * @param TableGatewayInterface $itemTable
     */
    public function __construct(TableGatewayInterface $orderTable, TableGatewayInterface $itemTable)
    {
        $this->orderTable = $orderTable;
        $this->itemTable = $itemTable;
    }

    public function find($id)
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrdersItemsHydratorStrategy(new ClassMethods()));
        $order = $this->orderTable->select(['id' => (int)$id])->current();

        if (!$order) {
            throw new \Exception('Entity not found.');
        }

        $items = $this->itemTable->select(['order_id' => $order->getId()]);

        foreach ($items as $item) {
            $order->addItem($item);
        }

        return $hydrator->extract($order);
    }

    public function findAll()
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrdersItemsHydratorStrategy(new ClassMethods()));
        $orders = $this->orderTable->select();
        $result = [];

        foreach ($orders as $order) {
            $items = $this->itemTable->select(['order_id' => $order->getId()]);
            foreach ($items as $item) {
                $order->addItem($item);
            }

            $result[] = $hydrator->extract($order);
        }

        $arrayAdapter = new ArrayAdapter($result);
        $ordersCollection = new OrdersCollection($arrayAdapter);

        return $ordersCollection;
    }

    public function insert(array $data)
    {
        $this->orderTable->insert($data);

        return $this->orderTable->getLastInsertValue();
    }

    public function update($id, array $data)
    {
        return $this->orderTable->update($data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->orderTable->delete(['id' => $id]);
    }

    public function insertItem(array $data)
    {
        $this->itemTable->insert($data);

        return $this->itemTable->getLastInsertValue();
    }

    public function getOrderTable()
    {
        return $this->orderTable;
    }

    public function getItemTable()
    {
        return $this->itemTable;
    }
}
