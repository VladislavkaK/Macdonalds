<?php

namespace App\ArrayAndList;


interface ListType
{

    public function get(int $index);

    public function set(int $index, $value);

    public function add($value): void;

    public function insert(int $index, $value);

    public function remove($index);

    public function size(): int;
}