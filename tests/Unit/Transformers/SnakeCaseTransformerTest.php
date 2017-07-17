<?php

namespace SimpleSerializer\Test\Unit\Transformers;

use PHPUnit\Framework\TestCase;
use SimpleSerializer\Transformers\SnakeCaseTransformer;

class SnakeCaseTransformerTest extends TestCase
{
    /** @var  SnakeCaseTransformer */
    private $strategy;

    protected function setUp()
    {
        $this->strategy = new SnakeCaseTransformer();
    }

    public function testItShouldReturnAnSnakeCaseString(): void
    {
        $result = $this->strategy->transform("testKeyKeyCool");
        $this->assertEquals("test_key_key_cool", $result);
    }

    public function testItShouldReturnTheSameWordIfAlreadyInSnakeCase(): void
    {
        $result = $this->strategy->transform("test_key_key_cool");
        $this->assertEquals("test_key_key_cool", $result);
    }
}