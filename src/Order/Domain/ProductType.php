<?php

namespace App\Order\Domain;

class ProductType
{
    const VALID_PRODUCT_TYPE = ['pizza', 'burger', 'sushi'];

    /**
     * @throws ProductTypeException
     */
    public function __construct(protected string $value)
    {
        $this->assertValueIsValid($this->value);
    }

    public static function create(string $value): ProductType
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    private function assertValueIsValid(string $value): void
    {
        if (!in_array($value, self::VALID_PRODUCT_TYPE)) {
            throw new  ProductTypeException();
        }
    }
}