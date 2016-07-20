<?php

namespace CodeOrders\V1\Rest\Products;

use Zend\Stdlib\Hydrator\HydratorInterface;

class ProductsMapper extends ProductsEntity implements HydratorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'id' => isset($object->id) ? $object->id : null,
            'name' => $object->name,
            'description' => $object->description,
            'price' => $object->price,
        ];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $object->id = $data['id'];
        $object->name = $data['name'];
        $object->description = $data['description'];
        $object->price = $data['price'];

        return $object;
    }
}
