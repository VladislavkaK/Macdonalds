<?php

namespace App\Product\Burgers;


use App\Product\Products;

class BigMac extends Products
{
    const NAME = 'bigmak';

    const PRICE = 135;

    public function __construct()
    {
        $this->price = self::PRICE;
        $this->name = self::NAME;
    }
}