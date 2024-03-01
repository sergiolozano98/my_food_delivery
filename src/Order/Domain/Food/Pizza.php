<?php

namespace App\Order\Domain\Food;

class Pizza extends Food
{
    const PIZZA_ID = 1;

    public function __construct()
    {
        $this->type = 'pizza';
        $this->price = 12.5;
        $this->id = self::PIZZA_ID;
    }
}