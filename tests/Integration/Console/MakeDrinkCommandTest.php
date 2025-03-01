<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Integration\Console;

use Deliverea\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Deliverea\CoffeeMachine\Drink\Infrastructure\Console\MakeDrinkCommand;
use Symfony\Component\Console\Tester\CommandTester;

class MakeDrinkCommandTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->application->add($this->container->get(MakeDrinkCommand::class));
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testCoffeeMachineReturnsTheExpectedOutput(
        string $drinkType,
        string $money,
        int $sugars,
        string $extraHot,
        string $expectedOutput
    ): void {
        $command = $this->application->find('app:order-drink');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'drink-type' => $drinkType,
            'money' => $money,
            'sugars' => $sugars,
            '--extra-hot' => $extraHot
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);
    }

    public function ordersProvider(): array
    {
        return [
            [
                'chocolate', '0.7', 1, '', 'You have ordered a chocolate with 1 sugars (stick included).' . PHP_EOL
            ],
            [
                'tea', '0.4', 0, '-e', 'You have ordered a tea extra hot' . PHP_EOL
            ],
            [
                'coffee', '2', 2, '-e', 'You have ordered a coffee extra hot with 2 sugars (stick included).' . PHP_EOL
            ],
            [
                'coffee', '0.2', 2, '-e', 'The coffee costs 0.5.' . PHP_EOL
            ],
            [
                'chocolate', '0.3', 2, '-e', 'The chocolate costs 0.6.' . PHP_EOL
            ],
            [
                'tea', '0.1', 2, '-e', 'The tea costs 0.4.' . PHP_EOL
            ],
            [
                'tea', '0.5', -1, '-e', 'The number of sugars should be between 0 and 2.' . PHP_EOL
            ],
            [
                'tea', '0.5', 3, '-e', 'The number of sugars should be between 0 and 2.' . PHP_EOL
            ],
        ];
    }
}
