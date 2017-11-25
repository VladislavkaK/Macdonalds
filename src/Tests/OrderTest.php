<?php

namespace Tests;


use App\Product\Burgers\BigMac;
use App\Product\Burgers\BigTeisti;
use App\Product\Drinks\Coffee;
use App\Product\Drinks\Fanta;
use App\Product\Products;
use PHPUnit\Framework\TestCase;
use App\Product\Drinks\CocaCola;
use App\Order;


class OrderTest extends TestCase
{
    private $order;

    public function setUp()
    {
        $this->order = new Order();
    }

    public function tearDown()
    {
        $this->order = null;
    }

    public function testAddProduct()
    {
        $this->order->add(new BigTeisti(), 10);
        $this->order->add(new CocaCola(), 10);
        $this->assertEquals(0, 0);

        $check =
        'Product name: bigteisti' . PHP_EOL
        .'Count: 10 pieces' . PHP_EOL
        .'Worth: '. BigTeisti::PRICE * 10 . ' rub.' . PHP_EOL
        .PHP_EOL.
        'Product name: coca-cola' . PHP_EOL
        .'Count: 10 pieces' . PHP_EOL
        .'Worth: '. CocaCola::PRICE_WATER * 10 . ' rub.' . PHP_EOL
        .PHP_EOL.
        'Product name: coffee' . PHP_EOL
        .'Count: 1 pieces' . PHP_EOL
        .'Worth: '. Coffee::PRICE_WATER * 1 . ' rub.' . PHP_EOL
        .PHP_EOL.
        'Order for an amount: 3300 rub.' . PHP_EOL;

        $this->assertEquals($check , $this->order->getCheck());
    }


    public function testExceptionDrink()
    {
        $this->expectException('OutOfRangeException');
        $this->order->add(new CocaCola(), 10);
        //$this->order->add(new CocaCola(-1), 10);
    }

    public function testExceptionPotato()
    {
        $this->expectException('OutOfRangeException');
        $this->order->add(new Fanta(10), 2);
       // $this->order->add(new Fanta(20), -1);
    }

    /**
     * @dataProvider orderAddProvider
     */
    public function testAddToOrder(array $products, array $counts, string $check)
    {
        $i = 0;
        while ($i <= count($counts) - 1) {

            $this->order->add($products[$i], $counts[$i]);
            $i++;
        }

        $result = $this->order->getCheck();

        $this->assertEquals($check, $result);
    }

    /**
     * @dataProvider orderRemoveProvider
     */
    public function testRemove(array $products, array $removes, string $check)
    {
        foreach ($products as $product) {
            $this->order->add($product, 1);
        }
        foreach ($removes as $remove) {
            $this->order->remove($remove);
        }

        $result = $this->order->getCheck();

        $this->assertEquals($check, $result);
    }

    public static function orderAddProvider() : array
    {
        return [
            [
                [new CocaCola()], // массив продуктов
                [5], // количество заказанных продуктов
                'Product name: coca-cola' . PHP_EOL
                .'Count: 5 pieces' . PHP_EOL
                .'Worth: '. CocaCola::PRICE_WATER * 5 . ' rub.' . PHP_EOL.PHP_EOL.
                'Order for an amount: 300 rub.' . PHP_EOL
            ],
            [
                [
                    new CocaCola(),
                    new CocaCola(),
                ],
                [5, 10],
                 'Product name: coca-cola' . PHP_EOL
                 .'Count: 15 pieces' . PHP_EOL
                 .'Worth: '. CocaCola::PRICE_WATER * 15 . ' rub.' . PHP_EOL.PHP_EOL.
                 'Order for an amount: 900 rub.' . PHP_EOL
            ],
            [
                [
                    new CocaCola(),
                    new BigMac(),
                ],
                [5, 2],
                    'Product name: coca-cola' . PHP_EOL
                    .'Count: 5 pieces' . PHP_EOL
                    .'Worth: '. CocaCola::PRICE_WATER * 5 . ' rub.' . PHP_EOL
                    .PHP_EOL.
                    'Product name: bigmak' . PHP_EOL
                    .'Count: 2 pieces' . PHP_EOL
                    .'Worth: '. BigMac::PRICE * 2 . ' rub.' . PHP_EOL
                    .PHP_EOL.
                    'Order for an amount: 570 rub.' . PHP_EOL
            ],

            [
                [
                    new CocaCola(),
                    new CocaCola(),
                    new Fanta(),
                    new Fanta(),
                    new BigMac(),
                ],
                [5, 1, 1, 1, 1],
                'Product name: coca-cola' . PHP_EOL
                .'Count: 6 pieces' . PHP_EOL
                .'Worth: '. CocaCola::PRICE_WATER * 6 . ' rub.' . PHP_EOL
                .PHP_EOL.
                'Product name: fanta' . PHP_EOL
                .'Count: 2 pieces' . PHP_EOL
                .'Worth: '. Fanta::PRICE_WATER * 2 . ' rub.' . PHP_EOL
                .PHP_EOL.
                'Product name: bigmak' . PHP_EOL
                .'Count: 1 pieces' . PHP_EOL
                .'Worth: '. BigMac::PRICE * 1 . ' rub.' . PHP_EOL
                .PHP_EOL.
                'Order for an amount: 615 rub.' . PHP_EOL
            ],
        ];
    }


    public static function orderRemoveProvider() : array
    {
        return [
            [
                [
                    new CocaCola(),
                    new CocaCola(),
                    new Fanta(),
                    new BigMac(),
                ],
                [1, 1, 1],
                'Product name: bigmak' . PHP_EOL
                .'Count: 1 pieces' . PHP_EOL
                .'Worth: '. BigMac::PRICE * 1 . ' rub.' . PHP_EOL.PHP_EOL.
                'Order for an amount: 135 rub.' . PHP_EOL
            ],
            [
                [
                    new CocaCola(),
                    new CocaCola(),
                ],
                [1],
                'Product name: coca-cola' . PHP_EOL
                .'Count: 1 pieces' . PHP_EOL
                .'Worth: '. CocaCola::PRICE_WATER * 1 . ' rub.' . PHP_EOL.PHP_EOL.
                'Order for an amount: 60 rub.' . PHP_EOL
            ],
            [
                [
                    new CocaCola(),
                    new Fanta(),
                ],
                [0],
                'Product name: fanta' . PHP_EOL
                .'Count: 1 pieces' . PHP_EOL
                .'Worth: '. Fanta::PRICE_WATER * 1 . ' rub.' . PHP_EOL.PHP_EOL.
                'Order for an amount: 60 rub.' . PHP_EOL
            ],
            [
                [
                    new Fanta(),
                    new CocaCola(),
                ],
                [0, 0],
                'Order for an amount: 0 rub.' . PHP_EOL
            ],
        ];
    }

}
