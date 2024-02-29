<?php

namespace App\Order\Domain\Calculator\Operations;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Product\Product;

class DeliveryOrder implements Operation
{
    public function execute(Product $product, Drink $drink): float
    {
        return $product->price() + ($drink->value() * 2) + 1.5;
    }

    public function support(Delivery $delivery): bool
    {
        return (true === $delivery->value());
    }
}