<?php

namespace App\Order\Domain\Calculator\Operations;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Product\Product;

interface Operation
{
    public function execute(Product $product, Drink $drink): float;

    public function support(Delivery $delivery): bool;
}