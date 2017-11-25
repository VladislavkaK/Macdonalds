<?php


namespace App;


use App\Product\Products;


class Position
{
    private $product;

    private $name;

    private $count;

    private $price;

    private $positionString;

    public function __construct(Products $product, int $count)
    {
        if ($count <= 0 ) {
            throw new \OutOfRangeException(' оличество заказанного продукта должно быть > 0');
        }

        $this->name = $product->getName();
        $this->price = $product->getPrice() * $count;
        $this->count = $count;
        $this->product = $product;
        $this->update();

    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getProduct() : Products
    {
        return $this->product;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count)
    {
        $this->count = $count;
        $this->update();
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getPositionString(): string
    {
        return $this->positionString;
    }

    private function update()
    {
        $this->price = $this->product->getPrice() * $this->count;
        $this->positionString = self::getStrTemplate($this->name, $this->count, $this->price);
    }

    public static function getStrTemplate(string $name, int $count, int $price)
    {
        return 'Product name: ' . $name .PHP_EOL.
            'Count: ' . $count . ' pieces'.PHP_EOL .
            'Worth: ' . $price . ' rub.' .PHP_EOL;
    }
}