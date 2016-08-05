<?php

namespace CodeOrders\V1\Rest\Orders;

use CodeOrders\V1\Rest\Clients\ClientsRepository;
use CodeOrders\V1\Rest\Ptypes\PtypesRepository;
use CodeOrders\V1\Rest\Users\UsersRepository;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersService
{
    /**
     * @var OrdersRepository
     */
    private $ordersRepository;
    /**
     * @var ClientsRepository
     */
    private $clientsRepository;
    /**
     * @var PtypesRepository
     */
    private $ptypesRepository;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * OrdersService constructor.
     * @param OrdersRepository $ordersRepository
     * @param ClientsRepository $clientsRepository
     * @param PtypesRepository $ptypesRepository
     * @param UsersRepository $usersRepository
     */
    public function __construct(
        OrdersRepository $ordersRepository,
        ClientsRepository $clientsRepository,
        PtypesRepository $ptypesRepository,
        UsersRepository $usersRepository
    ) {
        $this->ordersRepository = $ordersRepository;
        $this->clientsRepository = $clientsRepository;
        $this->ptypesRepository = $ptypesRepository;
        $this->usersRepository = $usersRepository;
    }

    public function find($id)
    {
        $order = $this->ordersRepository->find($id);
        $client = $this->clientsRepository->findBy(['id' => $order->getClientId()])->current();
        $ptype = $this->ptypesRepository->findBy(['id' => $order->getPtypeId()])->current();
        $user = $this->usersRepository->findBy(['id' => $order->getUserId()])->current();

        $sql = $this->ordersRepository->getItemTable()->getSql();
        $select = $sql->select();
        $select->join(
            'products',
            'order_items.product_id = products.id',
            ['product_name' => 'name']
        )->where(['order_id' => $order->getId()]);

        $items = $this->ordersRepository->getItemTable()->selectWith($select);

        foreach ($items as $item) {
            $order->addItem($item);
        }

        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrdersItemsHydratorStrategy(new ClassMethods()));

        $order->setClient($hydrator->extract($client));
        $order->setPtype($hydrator->extract($ptype));
        $order->setUser($hydrator->extract($user));

        $result = $hydrator->extract($order);

        unset($result['client_id']);
        unset($result['ptype_id']);
        unset($result['user_id']);
        unset($result['user']['username']);
        unset($result['user']['password']);

        return $result;
    }

    public function findAll()
    {
        $orders = $this->ordersRepository->getTableGateway()->select();
        $result = [];

        foreach ($orders as $order) {
            $result[] = $this->find($order->getId());
        }

        return $this->ordersRepository->getPaginator(new ArrayAdapter($result));
    }

    public function findBySalesman($id, $idSalesman)
    {
        $order = $this->ordersRepository->findBy(['id' => (int)$id, 'user_id' => (int)$idSalesman])->current();

        return $this->find($order->getId());
    }

    public function findAllBySalesman($idSalesman)
    {
        $orders = $this->ordersRepository->findBy(['user_id' => (int)$idSalesman]);
        $result = [];

        foreach ($orders as $order) {
            $result[] = $this->find($order->getId());
        }

        return $this->ordersRepository->getPaginator(new ArrayAdapter($result));
    }

    public function insert($data)
    {
        $total = 0;
        $items = $data->items;
        unset($data->items);

        $orderTable = $this->ordersRepository->getTableGateway();

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
            $order = $this->ordersRepository->insert($data);

            foreach ($items as $item) {
                $item['order_id'] = $order['id'];
                $this->ordersRepository->insertItem($item);
            }

            // Commit
            $orderTable->getAdapter()->getDriver()->getConnection()->commit();

            return $this->ordersRepository->find($order['id']);
        } catch (\Exception $e) {
            // Rollback
            $orderTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception('Error processing order.');
        }
    }

    public function update($idOrder, $data)
    {
        $order = $this->ordersRepository->find($idOrder);
        $items = $data->items;
        unset($data->items);
        $total = 0;

        $orderTable = $this->ordersRepository->getTableGateway();

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
                    $this->ordersRepository->updateItem($item['id'], $item);
                } else {
                    $item['order_id'] = $order['id'];
                    $this->ordersRepository->insertItem($item);
                }
            }

            $data->total = $this->getTotal($order['id']);
            $this->ordersRepository->update($order['id'], $data);

            // Commit
            $orderTable->getAdapter()->getDriver()->getConnection()->commit();

            return $this->ordersRepository->find($order['id']);
        } catch (\Exception $e) {
            // Rollback
            $orderTable->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception('Error processing order.');
        }
    }

    public function delete($id)
    {
        try {
            $order = $this->ordersRepository->find($id);
            $itemTable = $this->ordersRepository->getItemTable();
            $items = $itemTable->select(['order_id' => $order['id']]);

            foreach ($items as $item) {
                $itemTable->delete(['id' => $item->getId()]);
            }

            return $this->ordersRepository->delete($order['id']);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function getTotal($idOrder)
    {
        $total = 0;
        $items = $this->ordersRepository->getItemTable()->select(['order_id' => (int)$idOrder]);

        foreach ($items as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }
}
