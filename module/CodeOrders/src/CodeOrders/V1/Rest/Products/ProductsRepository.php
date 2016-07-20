<?php

namespace CodeOrders\V1\Rest\Products;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class ProductsRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * ProductsRepository constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function find($id)
    {
        $entity = $this->tableGateway->select(['id' => (int)$id]);

        return $entity->current();
    }

    public function findAll()
    {
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);

        return new ProductsCollection($paginatorAdapter);
    }

    public function insert($data)
    {
        $productsMapper = new ProductsMapper();
        $data = $productsMapper->extract($data);

        return $this->tableGateway->insert($data);
    }

    public function update($id, $data)
    {
        $productsMapper = new ProductsMapper();
        $data = $productsMapper->extract($data);

        return $this->tableGateway->update($data, ['id' => (int)$id]);
    }

    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int)$id]);
    }
}
