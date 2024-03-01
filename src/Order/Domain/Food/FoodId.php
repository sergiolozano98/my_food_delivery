<?php

namespace App\Order\Domain\Food;

class FoodId
{
    public function __construct(protected int $value)
    {
    }

    public static function create(int $value): FoodId
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}