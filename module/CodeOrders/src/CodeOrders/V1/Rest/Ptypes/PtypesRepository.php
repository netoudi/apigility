<?php

namespace CodeOrders\V1\Rest\Ptypes;

use CodeOrders\V1\Rest\Repository\AbstractRepository;

class PtypesRepository extends AbstractRepository
{
    public function collection()
    {
        return PtypesCollection::class;
    }
}