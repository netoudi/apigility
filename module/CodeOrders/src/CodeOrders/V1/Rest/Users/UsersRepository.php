<?php

namespace CodeOrders\V1\Rest\Users;

use CodeOrders\V1\Rest\Repository\AbstractRepository;

class UsersRepository extends AbstractRepository
{
    public function collection()
    {
        return UsersCollection::class;
    }
}
