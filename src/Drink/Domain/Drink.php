<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Domain;

use Deliverea\CoffeeMachine\Shared\Domain\Currency;

readonly class Drink
{
    public DrinkPrice $drinkPrice;
    public function __construct(public DrinkType $drinkType, public DrinkSugarsValueObject $numberOfSugars, public bool $isExtraHot) {
        $this->drinkPrice = match($drinkType){
            DrinkType::Tea => new DrinkPrice(0.4, Currency::Euro),
            DrinkType::Coffee => new DrinkPrice(0.5, Currency::Euro),
            DrinkType::Chocolate => new DrinkPrice(0.6, Currency::Euro)
        };
    }

    public static function create(DrinkType $drinkType, ?DrinkSugarsValueObject $drinkSugarsIn, ?bool $isExtraHot) : self {
        return new self($drinkType, $drinkSugarsIn ?? DrinkSugarsValueObject::tryFrom(0), $isExtraHot ?? false);
    }
}