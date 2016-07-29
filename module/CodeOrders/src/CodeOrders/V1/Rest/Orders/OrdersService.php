<?php

namespace CodeOrders\V1\Rest\Orders;

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
        $total = 0;
        $items = $data->items;
        unset($data->items);

        $orderTable = $this->repository->getTableGateway();

        try {
            // Begin Transaction
            $orderTable->getAdapter()->getDriver()->getConnection()->beginTransaction();

            foreach ($items as $key => $item) {
                $item['total'] = ($item['quantity'] * $item['price']);
                $items[$key]['total'] = $item['total'];
                $total += $item['total'];
            }

            $data->total = $total;
            $data->status = 0;
            $data->created_at = \date('Y-m-d H:i:s');
            $order = $this->repository->insert($data);

            foreach ($items as $item) {
                $item['order_id'] = $order['id'];
                $this->repository->insertItem($item);
            }

            // Commit
            $orderTable->getAdapter()->getDriver()->getConnection()->commit();

            return $this->repository->find($order['id']);
        } catch (\Exception $e) {
            // Rollback
            $orderTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception('Error processing order.');
        }
    }

    public function update($idOrder, $data)
    {
        $order = $this->repository->find($idOrder);
        $items = $data->items;
        unset($data->items);
        $total = 0;

        $orderTable = $this->repository->getTableGateway();

        try {
            // Begin Transaction
            $orderTable->getAdapter()->getDriver()->getConnection()->beginTransaction();

            foreach ($items as $key => $item) {
                $item['total'] = ($item['quantity'] * $item['price']);
                $items[$key]['total'] = $item['total'];
                $total += $item['total'];
            }

            foreach ($items as $item) {
                if (isset($item['id'])) {
                    $this->repository->updateItem($item['id'], $item);
                } else {
                    $item['order_id'] = $order['id'];
                    $this->repository->insertItem($item);
                }
            }

            $data->total = $this->getTotal($order['id']);
            $this->repository->update($order['id'], $data);

            // Commit
            $orderTable->getAdapter()->getDriver()->getConnection()->commit();

            return $this->repository->find($order['id']);
        } catch (\Exception $e) {
            // Rollback
            $orderTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception('Error processing order.');
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

    private function getTotal($idOrder)
    {
        $total = 0;
        $items = $this->repository->getItemTable()->select(['order_id' => (int)$idOrder]);

        foreach ($items as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }
}
