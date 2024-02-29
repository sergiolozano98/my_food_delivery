<?php

namespace App\Order\Domain\Calculator;

use App\Order\Domain\Calculator\Operations\Operation;
use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Product\Product;

class CalculateAmount
{
    public function __construct(protected iterable $operations)
    {
    }

    public function calculateAmount(Product $product, Drink $drink, Delivery $delivery): float
    {
        /** @var \App\Order\Domain\Calculator\Operations\Operation $operation */
        foreach ($this->operations as $operation) {
            if ($operation->support($delivery)) {
                return $operation->execute($product, $drink);
            }
        }
    }
}