<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Domain;

use Exception;

class InvalidDrinkTypeException extends Exception
{
    public function __construct()
    {
        parent::__construct("The drink type should be tea, coffee or chocolate.");
    }
}