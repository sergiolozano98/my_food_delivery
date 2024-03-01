<?php

namespace App\Order\Domain;

use App\Shared\Domain\Bus\Query\Response;

class OrdersResponse implements Response
{
    private readonly array $orders;

    public function __construct(OrderResponse ...$orders)
    {
        $this->orders = $orders;
    }

    public function orders(): array
    {
        return $this->orders;
    }
}