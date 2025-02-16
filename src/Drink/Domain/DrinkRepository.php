<?php

namespace Deliverea\CoffeeMachine\Drink\Domain;

interface DrinkRepository
{
    public function save(Drink $drink) : bool;
    
    /**
     * @return Drink[]
     */
    public function getAll() : array;
}

