<?php

namespace Deliverea\CoffeeMachine\Drink\Infrastructure;

use Deliverea\CoffeeMachine\Drink\Domain\DrinkPrice;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Shared\Domain\Currency;
use Deliverea\CoffeeMachine\Shared\Infrastructure\PDOConnection;
use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use PDO;

class PDODrinkRepository implements DrinkRepository
{
    private const TABLE = 'drinks';
    private $pdo;

    public function __construct(PDOConnection $pdo)
    {
        $this->pdo = $pdo->getPDO();
    }

    public function save(Drink $drink) : bool
    {
        $query = sprintf(
            'INSERT INTO %s (drink, numberOfSugars, price, extraHot) VALUES ("%s", %d, %.2f, %d)',
            $this::TABLE,
            $drink->drinkType->value,
            $drink->numberOfSugars->value(),
            $drink->price->value(),
            $drink->isExtraHot ? 1 : 0,
        );
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute();
    }

    public function getAll(): array
    {
        $query = "Select * from drinks";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $drinks = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $d) {
            $drinks[] = new Drink(
                DrinkType::from($d['drink']),
                DrinkSugarsValueObject::from($d['numberOfSugars']),
                (bool) $d['extraHot'],
                new DrinkPrice($d['price'], Currency::Euro),
            );
        }

        return $drinks;
    }
}