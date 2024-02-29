<?php

namespace App\Order\Application\Create;

class CreateOrderCommand
{
    public function __construct(
        private string $productType,
        private int $money,
        private bool   $delivery,
        private int    $drink
    )
    {
    }

    public function productType(): string
    {
        return $this->productType;
    }

    public function money(): string
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