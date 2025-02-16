<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Integration\Drink\Infrastructure;

use Deliverea\CoffeeMachine\Drink\Infrastructure\PDODrinkRepository;
use Deliverea\CoffeeMachine\Shared\Infrastructure\PDOConnection;
use Deliverea\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class PDODrinkRepositoryTest extends IntegrationTestCase
{
    private PDODrinkRepository $pdoDrinkRepository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->pdoDrinkRepository = $this->container->get(PDODrinkRepository::class);
        $this->cleanTable();
    }

    /** 
     * @test
     * @dataProvider drinksDataProvider
     */
    public function testPDOSavesAndReturnsDrink(array $drinksDataProvider): void
    {
        assertEmpty($this->pdoDrinkRepository->getAll());

        foreach($drinksDataProvider as $drink) {
            assertTrue($this->pdoDrinkRepository->save($drink));
        }
        
        assertEquals($this->pdoDrinkRepository->getAll(), $drinksDataProvider);

    }

    public static function drinksDataProvider(): array
    {
        return [
            [[
                Drink::create(DrinkType::create('coffee'), DrinkSugarsValueObject::From(1), true)
            ]],
        ];
    }

    private function cleanTable(): void
    {
        $this->container->get(PDOConnection::class)->getPDO()->exec("TRUNCATE TABLE drinks");
    }
}
