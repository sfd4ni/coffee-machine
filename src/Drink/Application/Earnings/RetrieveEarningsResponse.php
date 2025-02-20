<?php

namespace Deliverea\CoffeeMachine\Drink\Application\Earnings;

use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidDrinkTypeException;

class RetrieveEarningsResponse
{

    public function __construct(public float $chocolate = 0, public float $tea = 0, public float $coffee = 0)
    {
    }
}