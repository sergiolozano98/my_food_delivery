<?php

namespace App\Order\Domain\Calculator;

use App\Order\Domain\Calculator\Operations\Operation;
use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Food\Food;

class CalculateAmount
{
    public function __construct(protected iterable $operations)
    {
    }

    public function calculateAmount(Food $product, Drink $drink, Delivery $delivery): float
    {
        /** @var Operation $operation */
        foreach ($this->operations as $operation) {
            if ($operation->support($delivery)) {
                return $operation->execute($product, $drink);
            }
        }
    }
}