<?php

namespace App\Order\Domain;

class ProductTypeException extends \Exception
{
    public function __construct()
    {
        $message = sprintf('Selected food must be pizza, burger or sushi.');
        parent::__construct($message);
    }
}