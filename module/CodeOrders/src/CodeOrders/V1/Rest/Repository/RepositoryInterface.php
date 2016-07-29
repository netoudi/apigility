<?php

namespace CodeOrders\V1\Rest\Repository;

interface RepositoryInterface
{
    public function insert($data);

    public function update($id, $data);

    public function delete($id);

    public function find($id);

    public function findAll();

    public function findBy(array $columns);

    public function getTableGateway();
}
