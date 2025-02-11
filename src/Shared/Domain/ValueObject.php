<?php

declare(strict_types=1);
declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Shared\Domain;

interface ValueObject extends \JsonSerializable
{
    public function value(): mixed;
}