<?php

namespace App\Order\Domain\Product;

class Pizza extends Product
{
    public function __construct()
    {
        $this->type = 'pizza';
        $this->price = 12.5;
    }
}