<?php

namespace App\Order\Domain;

class Drink
{
    /**
     * @throws DrinkValueException
     */
    public function __construct(protected ?int $value)
    {
        $this->assertValueIsValid($this->value);
    }

    /**
     * @throws DrinkValueException
     */
    public static function create(?int $value): Drink
    {
        return new self($value);
    }

    public function value(): ?int
    {
        return $this->value;
    }

    /**
     * @throws DrinkValueException
     */
    private function assertValueIsValid(?int $value): void
    {
        if ($value !== null && ($value < 0 || $value > 2)) {
            throw new DrinkValueException();
        }
    }
}