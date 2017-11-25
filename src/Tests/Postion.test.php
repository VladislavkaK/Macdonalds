<?php

use App\Product\Burgers\BigMac;
use App\Position;
use PHPUnit\Framework\TestCase;
use App\Product\Drinks\CocaCola;

class PositionTest extends TestCase
{
    public function testPositoionCountException()
    {
        $this->expectException('OutOfRangeException');

        new Position(new BigMac(), 0);
        new Position(new CocaCola(CocaCola::PRICE_WATER), 0);
    }

    public function testGetName()
    {
        $position = new Position(new \App\Product\Burgers\Gamburger(\App\Product\Burgers\Gamburger::NAME), 10);

        $this->assertEquals('Gamburger', $position->getName());
    }
}
