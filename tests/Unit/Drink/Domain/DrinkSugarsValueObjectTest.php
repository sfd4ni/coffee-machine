<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Unit\Drink\Domain;

use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Drink\Domain\InvalidNumberOfSugarsException;
use PHPUnit\Framework\TestCase;

class DrinkSugarsValueObjectTest extends TestCase
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
        DrinkSugarsValueObject::from($numberOfSugars['number']);
    }

    public static function numberOfSugarsDataProvider(): array
    {
        return [
            [[
                'number' => -2, 
                'exception' => true,
            ]],
            [[
                'number' => 0, 
                'exception' => false,
            ]],
            [[
                'number' => 1, 
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
}