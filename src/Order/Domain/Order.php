<?php

namespace App\Order\Domain;

use App\Order\Domain\Food\FoodId;

class Order
{

    public function __construct(
        protected int      $id,
        protected FoodId   $foodId,
        protected Money    $money,
        protected Delivery $isDelivery,
        protected Amount   $amount,
        protected ?Drink   $drinks,
    )
    {
    }

    public static function create(int $id, FoodId $foodId, Money $money, Delivery $isDelivery, Amount $amount, ?Drink $drinks): Order
    {
        return new self($id, $foodId, $money, $isDelivery, $amount, $drinks);
    }

    public static function fromArray(array $data): Order
    {
        return new self(
            $data['id'],
            new FoodId($data['food']),
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

    public function foodId(): int
    {
        return $this->foodId->value();
    }

    public function amount(): float
    {
        return $this->amount->value();
    }
}