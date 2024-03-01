<?php

namespace App\Order\Domain;

use App\Order\Domain\Product\ProductId;

class Order
{

    public function __construct(
        protected int       $id,
        protected ProductId $product,
        protected Money     $money,
        protected Delivery  $isDelivery,
        protected Amount    $amount,
        protected ?Drink    $drinks,
    )
    {
    }

    public static function create(int $id, ProductId $product, Money $money, Delivery $isDelivery, Amount $amount, ?Drink $drinks): Order
    {
        return new self($id, $product, $money, $isDelivery, $amount, $drinks);
    }

    public static function fromArray(array $data): Order
    {
        return new self(
            $data['id'],
            new ProductId($data['food']),
            new Money($data['money']),
            new Delivery($data['delivery']),
            new Amount($data['amount']),
            new Drink($data['drink'])
        );
    }

    public function id(): int
    {
        return $this->id;
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

    public function productId(): int
    {
        return $this->product->value();
    }

    public function amount(): float
    {
        return $this->amount->value();
    }
}