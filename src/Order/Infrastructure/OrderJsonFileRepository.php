<?php

namespace App\Order\Infrastructure;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository;

class OrderJsonFileRepository implements OrderRepository
{
    const ORDER_JSON_FILE = 'etc/order/order.json';

    public function save(Order $order): void
    {
        $existingOrder = $this->loadExistingOrders();

        $newOrder = [
            'id' => $order->id(),
            'food' => $order->foodId(),
            'drink' => $order->drinks(),
            'delivery' => $order->isDelivery(),
            'money' => $order->money(),
            'amount' => $order->amount()
        ];

        $existingOrder[] = $newOrder;

        $this->saveOrdersToFile($existingOrder);
    }


    public function allDeliveryOrder(): array
    {
        $existingOrders = $this->loadExistingOrders();

        $filters = array_filter($existingOrders, function ($order) {
            return $order['delivery'] === true;
        });

        return array_map(function ($order) {
            return Order::fromArray($order);
        }, $filters);
    }

    private function loadExistingOrders()
    {
        $existingOrder = [];

        if (file_exists(self::ORDER_JSON_FILE)) {
            $jsonContent = file_get_contents(self::ORDER_JSON_FILE);
            $existingOrder = json_decode($jsonContent, true);
        }

        return $existingOrder;
    }

    private function saveOrdersToFile($orders): void
    {
        file_put_contents(self::ORDER_JSON_FILE, json_encode($orders, JSON_PRETTY_PRINT));
    }
}