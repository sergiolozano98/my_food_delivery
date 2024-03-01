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
use App\Order\Domain\Food\Factory\FoodFactory;
use App\Order\Domain\Food\FoodId;
use App\Shared\Domain\Bus\Command\CommandHandler;

readonly class CreateOrderCommandHandler implements CommandHandler
{
    public function __construct(
        private FoodFactory     $factory,
        private CalculateAmount $calculator,
        private OrderRepository $repository
    )
    {
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        $food = $this->factory->createFood($command->foodType());
        $drink = Drink::create($command->drinks());
        $money = Money::create($command->money());
        $delivery = Delivery::create($command->delivery());
        $amount = Amount::create($this->calculator->calculateAmount($food, $drink, $delivery));

        $this->isValidPayment($money, $delivery, $amount);

        $order = Order::create(
            random_int(0, 100),
            FoodId::create($food->id()),
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