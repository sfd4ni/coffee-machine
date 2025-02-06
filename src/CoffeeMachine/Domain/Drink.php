<?php

namespace Deliverea\CoffeeMachine\Domain;

use Deliverea\CoffeeMachine\Domain\DrinkPrice;
use Deliverea\Shared\Domain\Currency;

readonly class Drink
{
    public DrinkPrice $drinkPrice;
    public function __construct(public DrinkType $drinkType, public DrinkSugarsValueObject $drinkSugarsIn, public bool $isExtraHot = false) {
        $this->drinkPrice = match($drinkType){
            DrinkType::Tea => new DrinkPrice(0.4, Currency::Euro),
            DrinkType::Coffee => new DrinkPrice(0.5, Currency::Euro),
            DrinkType::Chocolate => new DrinkPrice(0.6, Currency::Euro)
        };
    }
}