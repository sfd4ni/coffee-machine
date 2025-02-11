<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Shared\Domain;

enum Currency
{
    case Euro;
    case Pound;
    case Dollar;
    case Yen;
}