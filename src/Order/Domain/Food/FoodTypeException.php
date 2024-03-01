<?php

namespace App\Order\Domain\Food;

class FoodTypeException extends \Exception
{
    public function __construct()
    {
        $message = sprintf('Selected food must be pizza, burger or sushi.');
        parent::__construct($message);
    }
}