<?php

namespace App\Order\Domain;

class Order
{

    public function __construct(
        protected ProductType $product,
        protected Money       $money,
        protected Delivery    $isDelivery,
        protected float       $amount,
        protected ?Drink      $drinks,
    )
    {
    }

    public static function create(ProductType $product, Money $money, Delivery $isDelivery, float $amount, ?Drink $drinks): Order
    {
        return new self($product, $money, $isDelivery, $amount, $drinks);
    }

    public function isDelivery(): bool
    {
        return $this->isDelivery->value();
    }

    public function money(): float
    {
        return $this->money->value();
    }

    public function drinks(): ?int
    {
        return $this->drinks->value();
    }

    public function calculateTotalOrderAmount(): float
    {
        if ($this->isDelivery()) {
            return $this->amount + ($this->drinks->value() * 2) + 1.5;
        } else {
            return $this->amount + ($this->drinks->value() * 2);
        }
    }

    public function validateMoney(): bool
    {
        $amount = $this->calculateTotalOrderAmount();

        if ($this->isDelivery()) {
            return $this->money() < $amount || $this->money() > $amount;
        }

        return $this->money() < $amount;
    }
}