<?php

namespace App\Product\Burgers;


use App\Product\Products;

class BigTeisti extends Products
{
    const NAME = 'bigteisti';

    const PRICE = 270;

    public function __construct()
    {
        $this->price = self::PRICE;
        $this->name = self::NAME;
    }
}