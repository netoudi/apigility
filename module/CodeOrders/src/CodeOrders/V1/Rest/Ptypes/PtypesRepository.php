<?php

namespace CodeOrders\V1\Rest\Ptypes;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\Stdlib\Hydrator\ObjectProperty;

class PtypesRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * PtypesRepository constructor.
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

        return new PtypesCollection($paginatorAdapter);
    }

    public function insert($data)
    {
        $hydrator = new ObjectProperty();

        return $this->tableGateway->insert($hydrator->extract($data));
    }

    public function update($id, $data)
    {
        $hydrator = new ObjectProperty();

        return $this->tableGateway->update($hydrator->extract($data), ['id' => (int)$id]);
    }

    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int)$id]);
    }
}