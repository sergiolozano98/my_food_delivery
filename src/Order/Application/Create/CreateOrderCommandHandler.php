<?php

namespace App\Order\Application\Create;

use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Money;
use App\Order\Domain\Order;
use App\Order\Domain\PaymentDeliveryException;
use App\Order\Domain\PaymentException;
use App\Order\Domain\Product\Factory\ProductFactory;
use App\Order\Domain\Product\Product;
use App\Shared\Domain\Bus\Command\CommandHandler;

readonly class CreateOrderCommandHandler implements CommandHandler
{
    public function __construct(private ProductFactory $factory)
    {
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        $product = $this->factory->createProduct($command->productType());
        $drink = Drink::create($command->drinks());
        $money = Money::create($command->money());
        $delivery = Delivery::create($command->delivery());
        $amount = $this->calculateAmount($product, $drink, $delivery);

        $this->isValidPayment($money, $delivery, $amount);

        $order = Order::create(
            $product,
            $money,
            $delivery,
            $drink
        );
    }

    private function isValidPayment(Money $money, Delivery $delivery, float $amount): void
    {
        if ($delivery->value() && ($money->value() < $amount || $money->value() > $amount)) {
            throw new PaymentDeliveryException();
        }

        if (!$delivery->value() && ($money->value() < $amount)) {
            throw new PaymentException();
        }
    }

    private function calculateAmount(Product $product, Drink $drink, Delivery $delivery): int|float
    {
        $amount = $product->price() + ($drink->value() * 2);

        if ($delivery->value()) {
            $amount = $amount + 1.5;
        }
        return $amount;
    }
}