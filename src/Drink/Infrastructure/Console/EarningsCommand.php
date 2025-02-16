<?php

namespace Deliverea\CoffeeMachine\Drink\Infrastructure\Console;

use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PDO;
class EarningsCommand extends Command
{
    const CODE_RESPONSE = 0;

    const DEFAULT_SOURCE = '';

    protected static $defaultName = 'app:earnings';

    public function __construct(private DrinkRepository $earningsRepository)
    {
        parent::__construct(self::$defaultName);
    }

    /**
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /*try {
            $source = $input->getArgument('source');
            $calculateEarnings = new CalculateEarnings($source);
            $output->writeln($calculateEarnings->calculate());
        
        } catch (Exception $e) {
            $output->writeln($e->getMessage());
        }*/
        
        //$pdoDrinkRepository = new PDODrinkRepository($pdo);
        //$pdoDrinkRepository->create();

        return self::CODE_RESPONSE;
    }
}
