<?php

namespace App\Order\Domain\Product;

class Burger extends Product
{
    public function __construct()
    {
        $this->type = 'burger';
        $this->price = 9;
    }
}