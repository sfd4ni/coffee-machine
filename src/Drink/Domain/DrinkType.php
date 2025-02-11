<?php

declare(strict_types=1);


namespace Deliverea\CoffeeMachine\Drink\Domain;

enum DrinkType : string
{
    case Tea = 'tea';
    case Coffee = 'coffee';
    case Chocolate = 'chocolate';

    public static function create(string $value): self {
        $value = strtolower($value);
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        throw new InvalidDrinkTypeException;
    }
}