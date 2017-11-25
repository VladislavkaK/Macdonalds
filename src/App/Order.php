<?php


namespace App;

use App\ArrayAndList\ArrayList;
use App\ArrayAndList\LinkedList;
use App\ArrayAndList\ListType;
use App\Product\Drinks\Coffee;
use App\Product\Products;
use PHPUnit\Runner\Exception;



class Order
{

    private $storage;

    private $coffee = false;

    private $presentSumm = 1000;

    public function getCheck(): string
    {
        $result = '';

        $summ = $this->getSumm();

        if ($summ >= $this->presentSumm && !$this->coffee) {
            $this->coffee = true;
            $this->add(new Coffee(), 1);
            echo 'Кофе БЕСПЛАТНО!!' . PHP_EOL;
        }

        $i = 0;
        while ($i < $this->storage->size()) {
            $position = $this->storage->get($i);
            if (!$this->coffee && $position->getName() === Coffee::NAME_WATER) {
                $this->remove($i);
                continue;
            }

            $result .= $position->getPositionString() . PHP_EOL;
            $i++;
        }
        $result .= "Order for an amount: $summ rub." . PHP_EOL;
        return $result;
    }

    private function getSumm(): int
    {
        $summ = 0;
        $i = 0;
        while ($i < $this->storage->size()) {
            $position = $this->storage->get($i);
            $summ += $position->getPrice();
            $i++;
        }
        return $summ;
    }

    public function __construct()
    {
        $this->storage = new ArrayList();
        //$this->storage = new LinkedList();
    }

    public function add(Products $product, int $count)
    {
        $position = new Position($product, $count);
        //  Если уже есть этот продукт, то увеличиваем кол-во внутри incrementIfExist
        if ($this->incrementIfExist($position)) {
            return;
        } else {
            $this->setByCount($position);
        }
    }

    private function setByCount(Position $position): void
    {

        $count = $position->getCount();
        $size = $this->storage->size();

        if ($size === 0) {
            $this->storage->add($position);
        } elseif ($size === 1) {
            // Если есть 1 элемент
            $previous = $this->storage->get(0);
            if ($previous->getCount() < $count) {
                $this->storage->insert(0, $position);
            } else {
                $this->storage->add($position);
            }
        } else {
            //  Если > 1 элемента

            for ($i = 0; $i <= $size - 1; $i++) {
                $current = $this->storage->get($i);

                if ($current->getCount() <= $count) {
                    $this->storage->insert($i, $position);
                    return;
                }
            }
            $this->storage->add($position);
        }
    }

    /**
     * @param Position $position
     * @return bool
     */
    private function incrementIfExist(Position $position): bool
    {
        $product = $position->getProduct();
        $size = $this->storage->size();

        for ($i = 0; $i <= $size - 1; $i++) {
            $productPosition = $this->storage->get($i);
            $productCount = $productPosition->getCount();
            if ($product == $productPosition->getProduct()) {
                $productPosition->setCount($productCount + $position->getCount());
                $position = clone $productPosition;
                $this->remove($i);
                $this->setByCount($position);
                return true;
            }
        }

        return false;
    }

    public function remove(int $index): void
    {
        $this->storage->remove($index);
    }
}