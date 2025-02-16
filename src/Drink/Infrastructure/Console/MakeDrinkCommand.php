<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Drink\Infrastructure\Console;

use Deliverea\CoffeeMachine\Drink\Application\Order\NotEnoughMoneyAmountException;
use Deliverea\CoffeeMachine\Drink\Application\Order\OrderDrink;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
Use Deliverea\CoffeeMachine\Drink\Domain\InvalidDrinkTypeException;
Use Deliverea\CoffeeMachine\Drink\Domain\InvalidNumberOfSugarsException;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure(): void
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $drinkType = strtolower($input->getArgument('drink-type'));
            $moneyAmount = (float) $input->getArgument('money');
            $numberOfSugars = (int) $input->getArgument('sugars');
            $extraHot = (bool) $input->getOption('extra-hot');

            $orderDrink = new OrderDrink();
            $orderDrink($drinkType, $moneyAmount, $numberOfSugars, $extraHot);

            $orderReply = sprintf('You have ordered a %s', $drinkType);
            if ($extraHot) {
                $orderReply = $orderReply.' extra hot';
            }

            if ($numberOfSugars > 0) {
                $orderReply = $orderReply.sprintf(' with %d sugars (stick included).', $numberOfSugars);
            }
            
            $output->writeln($orderReply);
            return Command::SUCCESS;

        } catch (InvalidDrinkTypeException | NotEnoughMoneyAmountException | InvalidNumberOfSugarsException $exception) {
            $output->writeln($exception->getMessage());
        }
        return Command::SUCCESS;
    }
}
