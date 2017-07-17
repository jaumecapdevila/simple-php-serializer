<?php

namespace SimpleSerializer\Test\Unit\Transformers;

use PHPUnit\Framework\TestCase;
use SimpleSerializer\Transformers\CamelCaseTransformer;

class CamelCaseTransformerTest extends TestCase
{
    /** @var  CamelCaseTransformer */
    private $strategy;

    protected function setUp()
    {
        $this->strategy = new CamelCaseTransformer();
    }

    public function testItShouldReturnAnSnakeCaseString(): void
    {
        $result = $this->strategy->transform("test_key_key_cool");
        $this->assertEquals("testKeyKeyCool", $result);
    }

    public function testItShouldReturnTheSameWordIfAlreadyInCamelCase(): void
    {
        $result = $this->strategy->transform("testKeyKeyCool");
        $this->assertEquals("testKeyKeyCool", $result);
    }
}