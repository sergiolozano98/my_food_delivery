<?php

namespace App\Order\Domain;

readonly class OrderResponse
{
    public function __construct(
        private int    $id,
        private int    $foodId,
        private ?int $drink,
        private bool   $delivery,
        private float  $money,
        private float  $amount
    ) {}

    public function id(): int
    {
        return $this->id;
    }

    public function foodId(): int
    {
        return $this->foodId;
    }

    public function drink(): ?int
    {
        return $this->drink;
    }

    public function delivery(): bool
    {
        return $this->delivery;
    }

    public function money(): float
    {
        return $this->money;
    }

    public function amount(): float
    {
        return $this->amount;
    }


}