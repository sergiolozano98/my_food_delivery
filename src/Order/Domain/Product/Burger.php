<?php

namespace App\Order\Domain\Product;

class Burger extends Product
{
    const BURGER_ID = 3;

    public function __construct()
    {
        $this->type = 'burger';
        $this->price = 9;
        $this->id = self::BURGER_ID;
    }
}