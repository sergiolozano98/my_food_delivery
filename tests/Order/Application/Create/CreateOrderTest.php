<?php

namespace Order\Application\Create;

use App\Order\Application\Create\CreateOrderCommand;
use App\Order\Application\Create\CreateOrderCommandHandler;
use App\Order\Domain\Calculator\CalculateAmount;
use App\Order\Domain\Calculator\Operations\DeliveryOrder;
use App\Order\Domain\Calculator\Operations\NormalOrder;
use App\Order\Domain\DrinkValueException;
use App\Order\Domain\PaymentDeliveryException;
use App\Order\Domain\PaymentException;
use App\Order\Domain\Product\Factory\ProductFactory;
use App\Order\Domain\Product\Pizza;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CreateOrderTest extends TestCase
{
    private ProductFactory $productFactory;

    protected function setUp(): void
    {
        $this->productFactory = $this->createMock(ProductFactory::class);

        $this->calculator = new CalculateAmount([new DeliveryOrder(), new NormalOrder()]);
        $this->handler = new CreateOrderCommandHandler($this->productFactory, $this->calculator);
    }

    #[Test]
    public function it_should_message_correct_when_order_is_success()
    {
        $this->productFactory
            ->expects($this->once())
            ->method('createProduct')
            ->willReturn(new Pizza());

        $command = new CreateOrderCommand('pizza', 14, true, null);

        $this->executeHandler($command);
    }

    #[Test]
    public function it_should_error_message_when_money_is_not_exactly_is_delivery()
    {
        $this->expectException(PaymentDeliveryException::class);

        $this->productFactory
            ->expects($this->once())
            ->method('createProduct')
            ->willReturn(new Pizza());

        $command = new CreateOrderCommand('pizza', 10, true, null);

        $this->executeHandler($command);
    }

    #[Test]
    public function it_should_error_message_when_money_is_not_exactly()
    {
        $this->expectException(PaymentException::class);

        $this->productFactory
            ->expects($this->once())
            ->method('createProduct')
            ->willReturn(new Pizza());

        $command = new CreateOrderCommand('pizza', 10, false, null);

        $this->executeHandler($command);
    }

    #[Test]
    public function it_should_error_message_when_drink_number_is_not_between_0_2()
    {
        $this->expectException(DrinkValueException::class);

        $this->productFactory
            ->expects($this->once())
            ->method('createProduct')
            ->willReturn(new Pizza());

        $command = new CreateOrderCommand('pizza', 10, true, 99);

        $this->executeHandler($command);
    }

    #[Test]
    public function it_should_message_when_included_drink_in_order()
    {
        $this->productFactory
            ->expects($this->once())
            ->method('createProduct')
            ->willReturn(new Pizza());

        $command = new CreateOrderCommand('pizza', 16, true, 1);

        $this->executeHandler($command);
    }

    private function executeHandler(CreateOrderCommand $command)
    {
        return ($this->handler)($command);
    }
}