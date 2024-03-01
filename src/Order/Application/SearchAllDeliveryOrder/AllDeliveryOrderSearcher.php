<?php

namespace App\Order\Application\SearchAllDeliveryOrder;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\OrderResponse;

use App\Order\Domain\OrdersResponse;
use function Lambdish\Phunctional\map;


readonly class AllDeliveryOrderSearcher
{
    public function __construct(private OrderRepository $repository)
    {
    }

    public function searchAllDeliveryOrder(): OrdersResponse
    {
        return new OrdersResponse(...map($this->toResponse(), $this->repository->allDeliveryOrder()));
    }

    private function toResponse(): callable
    {
        return static fn(Order $order): OrderResponse => new OrderResponse(
            $order->id(),
            $order->foodId(),
            $order->drinks(),
            $order->isDelivery(),
            $order->money(),
            $order->amount()
        );
    }
}