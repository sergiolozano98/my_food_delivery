<?php

namespace App\Order\Domain\Food;

class Burger extends Food
{
    const BURGER_ID = 3;

    public function __construct()
    {
        $this->type = 'burger';
        $this->price = 9;
        $this->id = self::BURGER_ID;
    }
}