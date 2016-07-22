<?php

namespace CodeOrders\V1\Rest\Ptypes;

class PtypesEntity
{
    protected $id;
    protected $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return PtypesEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return PtypesEntity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
