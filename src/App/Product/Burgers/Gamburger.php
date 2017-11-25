<?php

namespace App\Product\Burgers;


use App\Product\Products;

class Gamburger extends Products
{
    const NAME = 'gamburger';

    const PRICE = 30;

    public function __construct()
    {
        $this->price = self::PRICE;
        $this->name = self::NAME;
    }
}