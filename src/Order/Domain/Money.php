<?php

namespace App\Order\Domain;

class Money
{
    public function __construct(protected float $value)
    {
    }

    public static function create(float $value): Money
    {
        return new self($value);
    }

    public function value(): float
    {
        return $this->value;
    }
}