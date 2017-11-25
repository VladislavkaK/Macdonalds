<?php

namespace App\Product;

abstract class Products
{

    protected $name;

    protected $price;

    public function getName() : string
    {
        return $this->name;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

}