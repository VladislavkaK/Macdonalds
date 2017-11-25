<?php


namespace App\Product;

use App\Menu;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductAll()
    {
        $string = Menu::getAll();

        $expexted =
            'Product ¹ 1 bigmak price: 135' .  PHP_EOL .
            'Product ¹ 2 bigteisti price: 270' .PHP_EOL .
            'Product ¹ 3 chisburger price: 55' . PHP_EOL .
            'Product ¹ 4 gamburger price: 30' .PHP_EOL .
            'Product ¹ 5 coca-cola price: 60' .PHP_EOL .
            'Product ¹ 6 coffee price: 90' .  PHP_EOL .
            'Product ¹ 7 fanta price: 60' .  PHP_EOL ;


        $this->assertEquals($expexted, $string);
    }

}
