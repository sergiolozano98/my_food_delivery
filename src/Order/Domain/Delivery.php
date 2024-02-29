<?php

namespace App\Order\Domain;

class Delivery
{
    public function __construct(protected bool $value)
    {
    }

    public static function create(string $value): Delivery
    {
        return new self($value);
    }

    public function value(): bool
    {
        return $this->value;
    }
}