<?php

namespace App\Product\Burgers;


use App\Product\Products;

class Chisburger extends Products
{
    const NAME = 'chisburger';

    const PRICE = 55;

    public function __construct()
    {
        $this->price = self::PRICE;
        $this->name = self::NAME;
    }
}