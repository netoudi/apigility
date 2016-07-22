<?php

namespace CodeOrders\V1\Rest\Orders;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class OrdersItemsHydratorStrategy implements StrategyInterface
{
    /**
     * @var ClassMethods
     */
    private $hydrator;

    /**
     * OrdersItemsHydratorStrategy constructor.
     * @param ClassMethods $hydrator
     */
    public function __construct(ClassMethods $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $items
     * @return mixed Returns the value that should be extracted.
     * @internal param mixed $value The original value.
     * @internal param object $object (optional) The original object for context.
     */
    public function extract($items)
    {
        $data = [];

        foreach ($items as $item) {
            $data[] = $this->hydrator->extract($item);
        }

        return $data;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be hydrated.
     * @internal param array $data (optional) The original data for context.
     */
    public function hydrate($value)
    {
        throw new \RuntimeException('Hydration is not supported.');
    }
}
