<?php

namespace CodeOrders\V1\Rest\Users;

use Zend\Crypt\Password\Bcrypt;

class UsersService
{
    /**
     * @var UsersRepository
     */
    private $repository;

    /**
     * UsersService constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert($data)
    {
        $data->password = (new Bcrypt())->create($data->password);

        return $this->repository->insert($data);
    }

    public function update($id, $data)
    {
        if (isset($data->password)) {
            if (!empty($data->password)) {
                $data->password = (new Bcrypt())->create($data->password);
            } else {
                unset($data->password);
            }
        }

        return $this->repository->update($id, $data);
    }
}
