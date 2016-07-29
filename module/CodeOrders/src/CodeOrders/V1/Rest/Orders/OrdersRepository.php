<?php

namespace CodeOrders\V1\Rest\Orders;

use CodeOrders\V1\Rest\Repository\AbstractRepository;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersRepository extends AbstractRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $itemTable;

    public function __construct(TableGatewayInterface $orderTable, TableGatewayInterface $itemTable)
    {
        parent::__construct($orderTable);
        $this->itemTable = $itemTable;
    }

    public function find($id)
    {
        $order = parent::find($id);
        $items = $this->itemTable->select(['order_id' => $order->getId()]);

        foreach ($items as $item) {
            $order->addItem($item);
        }

        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrdersItemsHydratorStrategy(new ClassMethods()));

        return $hydrator->extract($order);
    }

    public function findAll()
    {
        $orders = $this->tableGateway->select();
        $result = [];

        foreach ($orders as $order) {
            $result[] = $this->find($order->getId());
        }

        return new $this->paginator(new ArrayAdapter($result));
    }

    public function insertItem(array $data)
    {
        $this->itemTable->insert($data);

        return $this->itemTable->select(['id' => $this->itemTable->getLastInsertValue()])->current();
    }

    public function updateItem($id, array $data)
    {
        $this->itemTable->update($data, ['id' => (int)$id]);

        return $this->itemTable->select(['id' => (int)$id])->current();
    }

    public function getItemTable()
    {
        return $this->itemTable;
    }

    public function findBySalesman($id, $idSalesman)
    {
        $order = parent::findBy(['id' => (int)$id, 'user_id' => (int)$idSalesman])->current();

        return $this->find($order->getId());
    }

    public function findAllBySalesman($idSalesman)
    {
        $orders = parent::findBy(['user_id' => (int)$idSalesman]);
        $result = [];

        foreach ($orders as $order) {
            $result[] = $this->find($order->getId());
        }

        return new $this->paginator(new ArrayAdapter($result));
    }

    public function collection()
    {
        return OrdersCollection::class;
    }
}
