<?php

namespace App\Order\Application\Create;

readonly class CreateOrderCommand
{
    public function __construct(
        private string $productType,
        private float  $money,
        private bool   $delivery,
        private int    $drink
    )
    {
    }

    public function productType(): string
    {
        return $this->productType;
    }

    public function money(): float
    {
        return $this->money;
    }

    public function delivery(): bool
    {
        return $this->delivery;
    }

    public function drinks(): int
    {
        return $this->drink;
    }
}