<?php

namespace App\Order\Domain;

interface OrderRepository
{
    public function save(Order $order);

    public function allDeliveryOrder();
}