<?php

namespace App\Order\Domain;

class Order
{

    public function __construct(
        protected string $product,
        protected Drink  $drink,
        protected Amount $amount,
        protected bool   $isDelivery
    )
    {
    }

    public static function create(string $product, Drink $drink, Amount $amount, bool $isDelivery): Order
    {
        return new self($product, $drink, $amount, $isDelivery);
    }
}