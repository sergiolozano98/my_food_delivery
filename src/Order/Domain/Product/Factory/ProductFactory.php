<?php

namespace App\Order\Domain\Product\Factory;

use App\Order\Domain\Product\Product;
use App\Order\Domain\ProductTypeException;

class ProductFactory
{
    public function __construct(protected iterable $products)
    {
    }

    public function createProduct(string $type): Product
    {
        /**@var Product $product */
        foreach ($this->products as $product) {
            if ($type === $product->type()) {
                return new $product;
            }
        }

        throw new ProductTypeException();
    }
}