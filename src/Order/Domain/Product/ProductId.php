<?php

namespace App\Order\Domain\Product;

class ProductId
{
    public function __construct(protected int $value)
    {
    }

    public static function create(int $value): ProductId
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}