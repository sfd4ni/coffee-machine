<?php

namespace Deliverea\CoffeeMachine\Drink\Application\Order;

use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Shared\Domain\Money;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Shared\Domain\Currency;

readonly class OrderDrink
{

    public function __invoke(string $drinkType, float $moneyAmount, ?int $numberOfSugars, ?bool $isExtraHot): DrinkResponse
    {
        $drink =  Drink::create(DrinkType::create($drinkType), DrinkSugarsValueObject::From($numberOfSugars), $isExtraHot);
        $money = new Money($moneyAmount, Currency::Euro);

        if ($drink->price->isBiggerThan($money)) {
            throw new NotEnoughMoneyAmountException($drink);
        }
        
        
        return DrinkResponse::createFromDrink($drink);
    }
}