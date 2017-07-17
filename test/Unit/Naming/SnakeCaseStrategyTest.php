<?php

namespace SimpleSerializer\Test\Unit\Naming;

use PHPUnit\Framework\TestCase;
use SimpleSerializer\Naming\SnakeCaseStrategy;

class SnakeCaseStrategyTest extends TestCase
{
    /** @var  SnakeCaseStrategy */
    private $strategy;

    protected function setUp()
    {
        $this->strategy = new SnakeCaseStrategy();
    }

    public function testItShouldReturnAnSnakeCaseString(): void
    {
        $result = $this->strategy->convert("testKeyKeyCool");
        $this->assertEquals("test_key_key_cool", $result);
    }

    public function testItShouldReturnTheSameWordIfAlreadyInSnakeCase(): void
    {
        $result = $this->strategy->convert("test_key_key_cool");
        $this->assertEquals("test_key_key_cool", $result);
    }
}