<?php

namespace App\Order\Domain\Food;

class Sushi extends Food
{
    const SUSHI_ID = 2;

    public function __construct()
    {
        $this->type = 'sushi';
        $this->price = 24;
        $this->id = self::SUSHI_ID;
    }
}