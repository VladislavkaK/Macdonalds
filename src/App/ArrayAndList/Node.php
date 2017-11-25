<?php

namespace App\ArrayAndList;

class Node
{
    private $next = null;
    private $value = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getNext(): ?self
    {
        return $this->next;
    }

    public function setNext(?self $next)
    {
        $this->next = $next;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}