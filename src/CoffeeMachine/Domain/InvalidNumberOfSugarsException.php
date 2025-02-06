<?php

namespace Deliverea\CoffeeMachine\Domain;

use Deliverea\Shared\Domain\ValueObject;
use Deliverea\Shared\Domain\IntValueObject;
use Deliverea\Shared\Domain\BoolValueObject;
use Exception;

class InvalidNumberOfSugarsException extends Exception
{
    public function __construct()
    {
        parent::__construct("The number of sugars should be between 0 and 2.");
    }
}