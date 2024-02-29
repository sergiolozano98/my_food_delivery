<?php

namespace App\Order\Application\Create;

use Symfony\Component\Config\Definition\Exception\Exception;

class CreateOrderCommandHandler
{
    public function __invoke(CreateOrderCommand $command): string
    {
        /*Order::create($command->productType(), $command->drink()->value(), $command->money()->value(), $command->delivery());*/

        if ($command->productType() == 'pizza' || $command->productType() == 'burger' || $command->productType() == 'sushi') {
            $foodAmount = 0;

            if ($command->productType() == 'pizza') {
                $foodAmount = 12.5;
            } elseif ($command->productType() == 'burger') {
                $foodAmount = 9;
            } elseif ($command->productType() == 'sushi') {
                $foodAmount = 24;
            }

            if ($command->drinks() < 0 || $command->drinks() > 2) {
                throw new Exception('Number of drinks should be between 0 and 2.');
            } else {
                if ($command->delivery() == true) {
                    $totalOrderAmount = $foodAmount + ($command->drinks() * 2) + 1.5;
                    if ($command->money() < $totalOrderAmount || $command->money() > $totalOrderAmount) {
                        throw new Exception('Money must be the exact order amount on delivery orders.');
                    }
                } else {
                    $totalOrderAmount = $foodAmount + ($command->drinks() * 2);
                    if ($command->money() < $totalOrderAmount) {
                        throw new Exception('Money does not reach the order amount.');
                    }
                }

                if ($command->drinks() > 0) {
                    $drinksIncludedString = 'with drinks included ';
                } else {
                    $drinksIncludedString = '';
                }

                return 'Your order ' . $drinksIncludedString . 'has been registered.';
            }
        } else {
            throw new Exception('Selected food must be pizza, burger or sushi.');
        }
    }
}