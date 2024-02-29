<?php

namespace App\Order\Domain;

class PaymentException extends \Exception
{
    public function __construct()
    {
        $message = sprintf('Money does not reach the order amount.');
        parent::__construct($message);
    }
}