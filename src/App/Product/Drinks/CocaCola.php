<?php


namespace App\Product\Drinks;


use App\Product\Products;


class CocaCola extends Products
{
    const NAME_WATER = 'coca-cola';
    const PRICE_WATER = 60;

    public function __construct()
    {
        $this->price = self::PRICE_WATER;
        $this->name = self::NAME_WATER;
    }
}