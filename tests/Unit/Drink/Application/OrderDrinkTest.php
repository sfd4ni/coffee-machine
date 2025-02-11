<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Unit\Application;

use Deliverea\CoffeeMachine\Drink\Application\Order\NotEnoughMoneyAmountException;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidNumberOfSugarsException;
use Deliverea\CoffeeMachine\Drink\Application\Order\OrderDrink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidDrinkTypeException;
use ValueError;
use PHPUnit\Framework\TestCase;

class OrderDrinkTest extends TestCase
{

    /** 
     * @test
     * @dataProvider numberOfSugarsDataProvider
     */
    public function testIsNumberOfSugarsValid(array $numberOfSugars): void
    {
        
        if ($numberOfSugars['exception']) {
            $this->expectException(InvalidNumberOfSugarsException::class);
            $this->expectExceptionMessage("The number of sugars should be between 0 and 2.");
        } else {
            $this->expectNotToPerformAssertions();
        }
        $orderDrink = new OrderDrink();
        $orderDrink('chocolate', 0.8, $numberOfSugars['number'], false);
    }

    /** 
     * @test
     * @dataProvider drinkTypeDataProvider
     */
    public function testIsDrinkTypeValid(array $drinkTypes): void
    {
        
        if ($drinkTypes['exception']) {
            $this->expectException(InvalidDrinkTypeException::class);
            $this->expectExceptionMessage("The drink type should be tea, coffee or chocolate.");
        } else {
            $this->expectNotToPerformAssertions();
        }
        $orderDrink = new OrderDrink();
        $orderDrink($drinkTypes['drinkType'], 0.8, 1, false);
    }

    /** 
     * @test
     * @dataProvider moneyAmountDataProvider
     */
    public function testIsMoneyAmountValid(array $moneyAmountDataProvider): void
    {
        
        if ($moneyAmountDataProvider['exception']) {
            $this->expectException(NotEnoughMoneyAmountException::class);
            //$this->expectExceptionMessage(sprintf('The %s costs %f.', NotEnoughMoneyAmountException::, $drink->drinkPrice->value()));
        } else {
            $this->expectNotToPerformAssertions();
        }
        $orderDrink = new OrderDrink();
        $orderDrink($moneyAmountDataProvider['drinkType'], $moneyAmountDataProvider['amount'], 1, false);
    }

    public static function numberOfSugarsDataProvider(): array
    {
        return [
            [[
                'number' => -2, 
                'exception' => true,
            ]],
            [[
                'number' => 1, 
                'exception' => false,
            ]],
            [[
                'number' => 0, 
                'exception' => false,
            ]],
            [[
                'number' => 2, 
                'exception' => false,
            ]],
            [[
                'number' => 3, 
                'exception' => true,
            ]]
        ];
    }

    public static function drinkTypeDataProvider(): array
    {
        return [
            [[
                'drinkType' => '', 
                'exception' => true,
            ]],
            [[
                'drinkType' => 'tea', 
                'exception' => false,
            ]],
            [[
                'drinkType' => 'Tea', 
                'exception' => false,
            ]],
            [[
                'drinkType' => 'chocolate', 
                'exception' => false,
            ]],
            [[
                'drinkType' => 'coffee', 
                'exception' => false,
            ]],
            [[
                'drinkType' => 'lemonade', 
                'exception' => true,
            ]]
        ];
    }

    public static function moneyAmountDataProvider(): array
    {
        return [
            [[
                'amount' => -2.0, 
                'drinkType' => 'tea', 
                'exception' => true,
            ]],
            [[
                'amount' => 0.43,
                'drinkType' => 'tea', 
                'exception' => false,
            ]],
            [[
                'amount' => 0.43,
                'drinkType' => 'coffee', 
                'exception' => true,
            ]],
            [[
                'amount' => 0.5,
                'drinkType' => 'coffee', 
                'exception' => false,
            ]],
            [[
                'amount' => 0.5,
                'drinkType' => 'chocolate', 
                'exception' => true,
            ]],
            [[
                'amount' => 0.6,
                'drinkType' => 'chocolate', 
                'exception' => false,
            ]],
        ];
    }
}