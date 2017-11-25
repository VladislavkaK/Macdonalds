<?php


namespace App;

use App\Product\Burgers\BigMac;
use App\Product\Burgers\BigTeisti;
use App\Product\Burgers\Chisburger;
use App\Product\Burgers\Gamburger;
use App\Product\Drinks\CocaCola;
use App\Product\Drinks\Coffee;
use App\Product\Drinks\Fanta;
use App\Product\Products;


class Menu
{

    public static function getAll() : string
    {
        return
            'Product ¹ 1 ' . BigMac::NAME . ' price: ' . BigMac::PRICE . PHP_EOL .
            'Product ¹ 2 ' . BigTeisti::NAME . ' price: ' . BigTeisti::PRICE . PHP_EOL .
            'Product ¹ 3 ' . Chisburger::NAME . ' price: ' . Chisburger::PRICE . PHP_EOL .
            'Product ¹ 4 ' . Gamburger::NAME . ' price: ' . Gamburger::PRICE . PHP_EOL .
            'Product ¹ 5 ' . CocaCola::NAME_WATER . ' price: ' . CocaCola::PRICE_WATER . PHP_EOL .
            'Product ¹ 6 ' . Coffee::NAME_WATER . ' price: ' . Coffee::PRICE_WATER . PHP_EOL .
            'Product ¹ 7 ' . Fanta::NAME_WATER . ' price: ' . Fanta::PRICE_WATER . PHP_EOL ;
    }

    public static function getProducts(int $id) : Products
    {
        switch ($id) {
            case 1:
                $product = new BigMac();
                break;
            case 2:
                $product = new BigTeisti();
                break;
            case 3:
                $product = new Chisburger();
                break;
            case 4:
                $product = new Gamburger();
                break;
            case 5:
                $product = new Fanta();
                break;
            case 6:
                $product = new Coffee();
                break;
            case 7:
                $product = new CocaCola();
                break;
        }

        return $product;
    }
}