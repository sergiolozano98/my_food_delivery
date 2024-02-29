<?php

namespace App\Order\Application\Create;

use App\Shared\Domain\Bus\Command\Command;

readonly class CreateOrderCommand implements Command
{
    public function __construct(
        private string $productType,
        private float  $money,
        private bool   $delivery,
        private ?int    $drink
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

    public function drinks(): ?int
    {
        return $this->drink;
    }
}