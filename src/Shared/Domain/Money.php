<?php

namespace Deliverea\Shared\Domain;

abstract readonly class Money
{
     public function __construct(public float $value, public Currency $currency) {
    }
}