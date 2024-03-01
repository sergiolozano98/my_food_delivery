<?php

namespace App\Order\Application\Create;

use App\Order\Domain\Amount;
use App\Order\Domain\Calculator\CalculateAmount;
use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Money;
use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\PaymentDeliveryException;
use App\Order\Domain\PaymentException;
use App\Order\Domain\Product\Factory\ProductFactory;
use App\Order\Domain\Product\ProductId;
use App\Shared\Domain\Bus\Command\CommandHandler;

readonly class CreateOrderCommandHandler implements CommandHandler
{
    public function __construct(
        private ProductFactory  $factory,
        private CalculateAmount $calculator,
        private OrderRepository $repository
    )
    {
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        $product = $this->factory->createProduct($command->productType());
        $drink = Drink::create($command->drinks());
        $money = Money::create($command->money());
        $delivery = Delivery::create($command->delivery());
        $amount = Amount::create($this->calculator->calculateAmount($product, $drink, $delivery));

        $this->isValidPayment($money, $delivery, $amount);

        $order = Order::create(
            random_int(0, 100),
            ProductId::create($product->id()),
            $money,
            $delivery,
            $amount,
            $drink
        );

        $this->repository->save($order);
    }

    private function isValidPayment(Money $money, Delivery $delivery, Amount $amount): void
    {
        if ($delivery->value() && ($money->value() < $amount->value() || $money->value() > $amount->value())) {
            throw new PaymentDeliveryException();
        }

        if (!$delivery->value() && ($money->value() < $amount->value())) {
            throw new PaymentException();
        }
    }
}