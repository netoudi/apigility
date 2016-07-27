<?php

namespace CodeOrders\V1\Rest\Orders;

use Zend\Stdlib\Hydrator\ObjectProperty;

class OrdersService
{
    /**
     * @var OrdersRepository
     */
    private $repository;

    /**
     * OrdersService constructor.
     * @param OrdersRepository $repository
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert($data)
    {
        $hydrator = new ObjectProperty();
        $data = $hydrator->extract($data);

        $items = $data['items'];
        unset($data['items']);

        $orderTable = $this->repository->getOrderTable();

        try {
            // Begin Transaction
            $orderTable->getAdapter()->getDriver()->getConnection()->beginTransaction();

            $orderId = $this->repository->insert($data);

            foreach ($items as $item) {
                $item['order_id'] = $orderId;
                $this->repository->insertItem($item);
            }

            // Commit
            $orderTable->getAdapter()->getDriver()->getConnection()->commit();

            return $this->repository->find($orderId);
        } catch (\Exception $e) {
            // Rollback
            $orderTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception('Error processing order.');
        }
    }

    public function update($id, $data)
    {
        try {
            if (isset($data['items'])) {
                unset($data['items']);
            }
            return $this->repository->update($id, $data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $order = $this->repository->find($id);
            $itemTable = $this->repository->getItemTable();
            $items = $itemTable->select(['order_id' => $order['id']]);

            foreach ($items as $item) {
                $itemTable->delete(['id' => $item->getId()]);
            }

            return $this->repository->delete($order['id']);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
