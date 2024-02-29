<?php

namespace App\Order\Domain\Product;

abstract class Product
{
    protected string $type;
    protected float $price;

    public function getType(): string
    {
        return $this->type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}