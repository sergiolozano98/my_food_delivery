<?php

namespace App\Order\Domain;

class ProductType
{
    public function __construct(protected string $value)
    {
    }

    public static function create(string $value): ProductType
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}