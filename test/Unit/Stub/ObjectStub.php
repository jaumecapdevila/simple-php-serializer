<?php

namespace SimpleSerializer\Test\Unit\Stub;


/**
 * @Naming\Strategy("SnakeCase")
 */
class ObjectStub
{
    private $property_a;
    private $property_b;

    /**
     * ObjectStub constructor.
     * @param $property_a
     * @param $property_b
     */
    public function __construct($property_a, $property_b)
    {
        $this->property_a = $property_a;
        $this->property_b = $property_b;
    }

    /**
     * @return mixed
     */
    public function getPropertyA()
    {
        return $this->property_a;
    }

    /**
     * @return mixed
     */
    public function getPropertyB()
    {
        return $this->property_b;
    }
}