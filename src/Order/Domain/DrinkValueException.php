<?php

namespace App\Order\Domain;

class DrinkValueException extends \Exception
{
    public function __construct()
    {
        $message = sprintf('Number of drinks should be between 0 and 2.');
        parent::__construct($message);
    }
}