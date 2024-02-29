<?php

namespace App\Order\Domain\Factory;

use App\Order\Domain\Product\Burger;
use App\Order\Domain\Product\Pizza;
use App\Order\Domain\Product\Product;
use App\Order\Domain\Product\Sushi;
use App\Order\Domain\ProductTypeException;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProductFactory
{
    public function createProduct(string $type): Product
    {
        switch ($type) {
            case 'pizza':
                return new Pizza();
            case 'burger':
                return new Burger();
            case 'sushi':
                return new Sushi();
            default:
                throw new ProductTypeException();
        }
    }
}