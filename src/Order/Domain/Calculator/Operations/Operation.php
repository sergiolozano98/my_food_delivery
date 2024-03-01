<?php

namespace App\Order\Domain\Calculator\Operations;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Food\Food;

interface Operation
{
    public function execute(Food $food, Drink $drink): float;

    public function support(Delivery $delivery): bool;
}