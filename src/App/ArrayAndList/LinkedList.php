<?php


namespace App\ArrayAndList;


class LinkedList implements ListType {
    private $first = null;

    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }

        $current = $this->first;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->getNext();
        }

        return $current->getValue();
    }

    public function set(int $index, $value) {
        //
    }

    // ��������� ������� � ����� ������
    public function add($value) : void
    {
        if (is_null($this->first)) {
            $this->first = new Node($value);
            return;
        }

        $current = $this->first;
        while (!is_null($current->getNext())) {
            $current = $current->getNext();
        }
        $current->setNext(new Node($value));
    }

    // ��������� �������
    public function insert(int $index, $value) {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }

        $previous = null;
        $current = $this->first;
        for ($i = 0; $i < $index; $i++) {
            $previous = $current;
            $current = $current->getNext();
        }

        if (is_null($previous)) {
            $this->first = new Node($value);
            $this->first->setNext($current);
            return;
        }

        $inserted = new Node($value);
        $inserted->setNext($current);
        $previous->setNext($inserted);
    }

    //������� ������
    public function remove($index)
    {
        if ($index < 0 || $index >= $this->size()) {
            throw new \Exception('Index out of bounds');
        }

        $previous = null;
        $current = $this->first;
        for ($i = 0; $i < $index; $i++) {
            $previous = $current;
            $current = $current->getNext();
        }

        if ($index === 0) {
            $this->first = $current->getNext();
            return;
        }

        if (is_null($previous)) {
            $this->first = null;
            return;
        }

        $previous->setNext($current->getNext());
    }

    //������
    public function size() : int {
        if (is_null($this->first)) {
            return 0;
        }

        $count = 1;
        $current = $this->first;
        while (!is_null($current->getNext())) {
            $current = $current->getNext();
            $count++;
        }

        return $count;
    }
}