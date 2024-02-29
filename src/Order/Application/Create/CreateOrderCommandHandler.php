<?php

namespace App\Order\Application\Create;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Factory\ProductFactory;
use App\Order\Domain\Money;
use App\Order\Domain\Order;

readonly class CreateOrderCommandHandler
{
    public function __construct(private ProductFactory $factory)
    {
    }

    public function __invoke(CreateOrderCommand $command): string
    {
        $order = Order::create(
            $this->factory->createProduct($command->productType()),
            Money::create($command->money()),
            Delivery::create($command->delivery()),
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