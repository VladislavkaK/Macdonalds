<?php


namespace App\Product\Drinks;


use App\Product\Products;


class Coffee extends Products
{
    const NAME_WATER = 'coffee';

    const PRICE_WATER = 90;

    public function __construct()
    {
        $this->price = self::PRICE_WATER;
        $this->name = self::NAME_WATER;
    }
}