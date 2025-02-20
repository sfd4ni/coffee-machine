<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Unit\Drink\Application;

use Deliverea\CoffeeMachine\Drink\Application\Earnings\RetrieveEarnings;
use Deliverea\CoffeeMachine\Drink\Application\Order\NotEnoughMoneyAmountException;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidNumberOfSugarsException;
use Deliverea\CoffeeMachine\Drink\Application\Order\OrderDrink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidDrinkTypeException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RetrieveEarningsTest extends TestCase
{

    private RetrieveEarnings $retrieveEarnings;
    private DrinkRepository | MockObject $drinkRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->drinkRepository = $this->createMock(DrinkRepository::class);
        $this->retrieveEarnings = new RetrieveEarnings($this->drinkRepository);
    }
    /** 
     * @test
     */
    public function testEarningsAreCorrect(): void
    {
        $tea = 0;
        $coffee = 0;
        $chocolate = 0;
        foreach($this->drinkRepository->getAll() as $drink) {
            switch ($drink->drinkType) {
                case DrinkType::Chocolate:
                    $chocolate += $drink->price->value();
                case DrinkType::Tea:
                    $tea += $drink->price->value();
                case DrinkType::Coffee:
                    $coffee += $drink->price->value();
                default:
            }
        }
        $this->assertEquals($tea, $this->retrieveEarnings->__invoke()->$tea);
        $this->assertEquals($coffee, $this->retrieveEarnings->__invoke()->$coffee);
        $this->assertEquals($chocolate, $this->retrieveEarnings->__invoke()->$chocolate);
    }
}