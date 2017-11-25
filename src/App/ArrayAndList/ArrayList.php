<?php


namespace App\ArrayAndList;


class ArrayList implements ListType {
    private $data = [];

    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }
        return $this->data[$index];
    }

    public function set(int $index, $value) : void
    {
        $this->data[$index] = $value;
    }

    // Добавляем элемент в конец списка
    public function add($value) : void
    {
        $this->data[] =  $value;
    }

    public function insert(int $index, $value) : void
    {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }
        array_splice($this->data, $index, 0, [$value]);
    }

    public function remove($index) : void
    {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }

        array_splice($this->data, $index, 1);
    }

    public function size() : int
    {
        return count($this->data);
    }
}