<?php

namespace CodeOrders\V1\Rest\Clients;

use CodeOrders\V1\Rest\Repository\AbstractRepository;

class ClientsRepository extends AbstractRepository
{
    public function collection()
    {
        return ClientsCollection::class;
    }
}
