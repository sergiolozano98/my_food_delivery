<?php

namespace App\Order\Domain\Product;

class Sushi extends Product
{
    public function __construct()
    {
        $this->type = 'pizza';
        $this->price = 24;
    }
}