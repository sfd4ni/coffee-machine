<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Application\Order;

use Exception;
use Deliverea\CoffeeMachine\Drink\Domain\Drink;
class NotEnoughMoneyAmountException extends Exception
{
    public function __construct(Drink $drink)
    {

        parent::__construct(sprintf('The %s costs %.1f.', $drink->drinkType->value, $drink->price->value()));
    }
}