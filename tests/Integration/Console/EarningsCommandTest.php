<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Integration\Console;

use Deliverea\CoffeeMachine\Drink\Domain\Drink;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkSugarsValueObject;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;
use Deliverea\CoffeeMachine\Drink\Infrastructure\Console\EarningsCommand;
use Deliverea\CoffeeMachine\Shared\Infrastructure\PDOConnection;
use Deliverea\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class EarningsCommandTest extends IntegrationTestCase
{
    private DrinkRepository $drinkRepository;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->drinkRepository = $this->container->get(DrinkRepository::class);
        $this->cleanTable();
        $this->application->add($this->container->get(EarningsCommand::class));
    }

    public function testEarningsReturnsTheExpectedOutput(): void {
        $this->drinkRepository->save(Drink::create(DrinkType::Chocolate, DrinkSugarsValueObject::from(1), true));
        $this->drinkRepository->save(Drink::create(DrinkType::Tea, DrinkSugarsValueObject::from(2), false));
        
        $command = $this->application->find('app:earnings');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName()));

        $expectedOutput= sprintf(EarningsCommand::OUTPUT_FORMAT . "\n", 0.40, 0.00, 0.60);
        $output = $commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);
    }

    private function cleanTable(): void
    {
        $this->container->get(PDOConnection::class)->getPDO()->exec("TRUNCATE TABLE drinks");
    }
}
