<?php

namespace CodeOrders\V1\Rest\Orders;

use CodeOrders\V1\Rest\Repository\AbstractRepository;
use Zend\Db\TableGateway\TableGatewayInterface;

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

    public function collection()
    {
        return OrdersCollection::class;
    }
}
