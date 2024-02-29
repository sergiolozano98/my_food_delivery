<?php

namespace App\Order\Domain\Pizza;

use App\Order\Domain\Product;

class Pizza extends Product
{
    const PIZZA_PRICE = 12.5;

    public function productType(): string
    {
        return 'pizza';
    }

    public function price(): string
    {
        return self::PIZZA_PRICE;
    }
}