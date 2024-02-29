<?php

namespace App\Order\Application\Create;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\DrinkValueException;
use App\Order\Domain\Money;
use App\Order\Domain\Order;
use App\Order\Domain\ProductType;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateOrderCommandHandler
{
    /**
     * @throws DrinkValueException
     * @throws \Exception
     */
    public function __invoke(CreateOrderCommand $command): string
    {
        $foodAmount = 0;

        if ($command->productType() == 'pizza') {
            $foodAmount = 12.5;
        } elseif ($command->productType() == 'burger') {
            $foodAmount = 9;
        } elseif ($command->productType() == 'sushi') {
            $foodAmount = 24;
        }

        $order = Order::create(
            ProductType::create($command->productType()),
            Money::create($command->money()),
            Delivery::create($command->delivery()),
            $foodAmount,
            Drink::create($command->drinks())
        );

        if ($order->validateMoney()) {
            $message = $order->isDelivery()
                ? 'Money must be the exact order amount on delivery orders.'
                : 'Money does not reach the order amount.';

            throw new \Exception($message);
        }

        return sprintf('Your order%s has been registered.', ($order->drinks() > 0) ? ' with drinks included' : '');
    }
}