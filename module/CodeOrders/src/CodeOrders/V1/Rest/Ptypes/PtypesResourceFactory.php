<?php
namespace CodeOrders\V1\Rest\Ptypes;

class PtypesResourceFactory
{
    public function __invoke($services)
    {
        return new PtypesResource($services->get('CodeOrders\\V1\\Rest\\Ptypes\\PtypesRepository'));
    }
}
