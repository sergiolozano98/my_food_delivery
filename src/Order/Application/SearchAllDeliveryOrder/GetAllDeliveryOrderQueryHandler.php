<?php

namespace App\Order\Application\SearchAllDeliveryOrder;

use App\Order\Domain\OrdersResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;

readonly class GetAllDeliveryOrderQueryHandler implements QueryHandler
{
    public function __construct(
        private AllDeliveryOrderSearcher $searcher
    )
    {
    }

    public function __invoke(GetAllDeliveryOrderQuery $query): OrdersResponse
    {
        return $this->searcher->searchAllDeliveryOrder();
    }
}