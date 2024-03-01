<?php

namespace Order\Application\SearchAllDeliveryOrder;

use App\Backoffice\User\Domain\UserResponse;
use App\Order\Application\SearchAllDeliveryOrder\AllDeliveryOrderSearcher;
use App\Order\Application\SearchAllDeliveryOrder\GetAllDeliveryOrderQuery;
use App\Order\Application\SearchAllDeliveryOrder\GetAllDeliveryOrderQueryHandler;
use App\Order\Domain\Amount;
use App\Order\Domain\Delivery;
use App\Order\Domain\Drink;
use App\Order\Domain\Food\FoodId;
use App\Order\Domain\Money;
use App\Order\Domain\Order;
use App\Order\Domain\OrderId;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\OrderResponse;
use App\Order\Domain\OrdersResponse;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SearchAllDeliveryOrderTest extends TestCase
{
    private OrderRepository $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(OrderRepository::class);

        $this->searcher = new AllDeliveryOrderSearcher($this->repository);
        $this->handler = new GetAllDeliveryOrderQueryHandler($this->searcher);
    }

    #[Test]
    public function it_should_message_correct_when_order_is_success()
    {
        $uuid = Uuid::random();
        $this->repository
            ->expects($this->once())
            ->method('allDeliveryOrder')
            ->willReturn([new Order(
                new OrderId($uuid->value()),
                FoodId::create(1),
                Money::create(14),
                Delivery::create(true),
                Amount::create(14),
                Drink::create(null)
            )]);

        $command = new GetAllDeliveryOrderQuery();

        $result = $this->executeHandler($command);
        $expect = new OrdersResponse(new OrderResponse($uuid->value(), 1, null, true, 14, 14));

        $this->assertEquals($expect, $result);
    }

    private function executeHandler(GetAllDeliveryOrderQuery $query)
    {
        return ($this->handler)($query);
    }
}