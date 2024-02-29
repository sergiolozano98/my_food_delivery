<?php

namespace App\Order\Domain;

use App\Order\Domain\Product\Product;

class Order
{

    public function __construct(
        protected Product  $product,
        protected Money    $money,
        protected Delivery $isDelivery,
        protected ?Drink   $drinks,
    )
    {
    }

    public static function create(Product $product, Money $money, Delivery $isDelivery, ?Drink $drinks): Order
    {
        return new self($product, $money, $isDelivery, $drinks);
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
            return $this->product->getPrice() + ($this->drinks->value() * 2) + 1.5;
        } else {
            return $this->product->getPrice() + ($this->drinks->value() * 2);
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