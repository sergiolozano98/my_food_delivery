<?php

namespace App\Order\Domain\Food\Factory;

use App\Order\Domain\Food\Food;
use App\Order\Domain\Food\FoodTypeException;

class FoodFactory
{
    public function __construct(protected iterable $foods)
    {
    }

    public function createFood(string $type): Food
    {
        /**@var Food $food */
        foreach ($this->foods as $food) {
            if ($type === $food->type()) {
                return new $food;
            }
        }

        throw new FoodTypeException();
    }
}