<?php

namespace CodeOrders\V1\Rest\Products;

use CodeOrders\V1\Rest\Repository\AbstractRepository;

class ProductsRepository extends AbstractRepository
{
    public function collection()
    {
        return ProductsCollection::class;
    }
}
