<?php

namespace App\Order\Application\Create;

use App\Shared\Domain\Bus\Command\Command;

readonly class CreateOrderCommand implements Command
{
    public function __construct(
        private string $foodType,
        private float  $money,
        private bool   $delivery,
        private ?int   $drink
    )
    {
    }

    public function foodType(): string
    {
        return $this->foodType;
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