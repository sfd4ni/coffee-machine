<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Shared\Domain;

readonly class Money
{
     public function __construct(private float $value, private Currency $currency) {
    }

    public function isBiggerThan(Money $otherMoney): bool
    {
        return $this->value > $otherMoney->value && $this->currency == $otherMoney->currency;
    }

    public function value() : float {
        return $this->value;
    }

    public function currency() : Currency {
        return $this->currency;
    }
}