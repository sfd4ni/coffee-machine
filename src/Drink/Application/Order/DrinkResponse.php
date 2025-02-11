<?php

namespace Deliverea\CoffeeMachine\Drink\Application\Order;

use Deliverea\CoffeeMachine\Drink\Domain\Drink;

readonly class DrinkResponse
{
    private function __construct(public string $drinkType, public int $numberOfSugars, public bool $isExtraHot)
    {
        
    }

    public static function createFromDrink(Drink $drink) : self {
        return new DrinkResponse($drink->drinkType->value, $drink->numberOfSugars->value(), $drink->isExtraHot);
    }
}