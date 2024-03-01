<?php

namespace App\Order\Domain;

class PaymentDeliveryException extends \Exception
{
    public function __construct()
    {
        $message = sprintf('Money must be the exact order amount on delivery orders.');
        parent::__construct($message);
    }
}