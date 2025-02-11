<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Domain;

use Exception;

class InvalidNumberOfSugarsException extends Exception
{
    public function __construct()
    {
        parent::__construct("The number of sugars should be between 0 and 2.");
    }
}