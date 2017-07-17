<?php

namespace SimpleSerializer\Test\Unit\Naming;

use PHPUnit\Framework\TestCase;
use SimpleSerializer\Naming\CamelCaseStrategy;

class CamelCaseStrategyTest extends TestCase
{
    /** @var  CamelCaseStrategy */
    private $strategy;

    protected function setUp()
    {
        $this->strategy = new CamelCaseStrategy();
    }

    public function testItShouldReturnAnSnakeCaseString(): void
    {
        $result = $this->strategy->convert("test_key_key_cool");
        $this->assertEquals("testKeyKeyCool", $result);
    }

    public function testItShouldReturnTheSameWordIfAlreadyInCamelCase(): void
    {
        $result = $this->strategy->convert("testKeyKeyCool");
        $this->assertEquals("testKeyKeyCool", $result);
    }
}