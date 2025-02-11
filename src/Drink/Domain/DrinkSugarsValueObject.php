<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Domain;

use Deliverea\CoffeeMachine\Shared\Domain\IntValueObject;

readonly class DrinkSugarsValueObject extends IntValueObject
{
    protected function validate(): void {
        
        if ($this->value() == 0 || 
        $this->value() == 1 ||
        $this->value() == 2 ) {
            return;
        }
        throw new InvalidNumberOfSugarsException();
    }
}