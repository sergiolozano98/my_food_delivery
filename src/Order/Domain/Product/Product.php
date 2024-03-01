<?php

namespace App\Order\Domain\Product;

abstract class Product
{
    protected string $type;
    protected float $price;
    protected int $id;

    public function type(): string
    {
        return $this->type;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function id(): int
    {
        return $this->id;
    }
}