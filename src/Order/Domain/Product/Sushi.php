<?php

namespace App\Order\Domain\Product;

class Sushi extends Product
{
    const SUSHI_ID = 2;

    public function __construct()
    {
        $this->type = 'pizza';
        $this->price = 24;
        $this->id = self::SUSHI_ID;
    }
}