<?php

namespace CodeOrders\V1\Rest\Repository;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\Paginator\Paginator;
use Zend\Stdlib\Hydrator\ObjectProperty;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Paginator
     */
    protected $paginator;
    /**
     * @var TableGatewayInterface
     */
    protected $tableGateway;

    /**
     * RepositoryAbstract constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->paginator = $this->collection();
    }

    public abstract function collection();

    public function insert($data)
    {
        $hydrator = new ObjectProperty();
        $this->tableGateway->insert($hydrator->extract($data));

        return $this->find($this->tableGateway->getLastInsertValue());
    }

    public function update($id, $data)
    {
        $this->find($id);

        $hydrator = new ObjectProperty();
        $this->tableGateway->update($hydrator->extract($data), ['id' => (int)$id]);

        return $this->find($id);
    }

    public function delete($id)
    {
        $this->find($id);

        try {
            $this->tableGateway->delete(['id' => (int)$id]);
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Could not delete the entity.', 500);
        }
    }

    public function find($id)
    {
        return $this->findBy(['id' => (int)$id])->current();
    }

    public function findAll()
    {
        return new $this->paginator(new DbTableGateway($this->tableGateway));
    }

    public function findBy(array $columns)
    {
        $result = $this->tableGateway->select($columns);

        if (!$result->current()) {
            throw new \Exception('Entity not found.', 404);
        }

        return $result;
    }

    public function getTableGateway()
    {
        return $this->tableGateway;
    }
}
