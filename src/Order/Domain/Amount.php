<?php

namespace App\Order\Domain;

class Amount
{
    public function __construct(protected float $value)
    {
    }

    public static function create(float $value): Amount
    {
        return new self($value);
    }

    public function value(): float
    {
        return $this->value;
    }
}