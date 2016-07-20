<?php

namespace CodeOrders\V1\Rest\Users;

use Zend\Crypt\Password\Bcrypt;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class UsersRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * UsersRepository constructor.
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

        return new UsersCollection($paginatorAdapter);
    }

    public function insert($data)
    {
        $usersMapper = new UsersMapper();
        $data = $usersMapper->extract($data);
        $data['password'] = (new Bcrypt())->create($data['password']);

        return $this->tableGateway->insert($data);
    }

    public function update($id, $data)
    {
        $usersMapper = new UsersMapper();
        $data = $usersMapper->extract($data);
        $data['password'] = (new Bcrypt())->create($data['password']);

        return $this->tableGateway->update($data, ['id' => (int)$id]);
    }

    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int)$id]);
    }
}
