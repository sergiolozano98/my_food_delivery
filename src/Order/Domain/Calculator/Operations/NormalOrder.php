<?php

namespace App\Order\Domain\Calculator\Operations;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Food\Food;

class NormalOrder implements Operation
{
    public function execute(Food $food, Drink $drink): float
    {
        return $food->price() + ($drink->value() * 2);
    }

    public function support(Delivery $delivery): bool
    {
        return (false === $delivery->value());
    }
}