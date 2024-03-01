<?php

namespace App\Order\Domain\Product;

class Pizza extends Product
{
    const PIZZA_ID = 1;

    public function __construct()
    {
        $this->type = 'pizza';
        $this->price = 12.5;
        $this->id = self::PIZZA_ID;
    }
}