<?php

namespace SimpleSerializer\Test\Unit;

use PHPUnit\Framework\TestCase;
use SimpleSerializer\JsonSerializer;
use SimpleSerializer\Test\Unit\Stub\ObjectStub;
use SimpleSerializer\Naming\CamelCaseStrategy;

class JsonSerializerTest extends TestCase
{
    /** @var  JsonSerializer */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new JsonSerializer(new CamelCaseStrategy());
    }

    public function testItShouldReturnTheSameValueAsStringIfScalar(): void
    {
        $result = $this->serializer->serialize(1);
        $this->assertEquals("1", $result);

        $result = $this->serializer->serialize("test");
        $this->assertEquals("\"test\"", $result);

        $result = $this->serializer->serialize(false);
        $this->assertEquals("false", $result);
    }

    public function testItShouldReturnAValidJsonIfObjectGiven(): void
    {
        $object = new ObjectStub("first property", "second property");
        $result = $this->serializer->serialize($object);
    }
}