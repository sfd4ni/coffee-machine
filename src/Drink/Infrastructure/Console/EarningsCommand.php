<?php

namespace Deliverea\CoffeeMachine\Drink\Infrastructure\Console;

use Deliverea\CoffeeMachine\Drink\Application\Earnings\RetrieveEarnings;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PDO;
class EarningsCommand extends Command
{
    const CODE_RESPONSE = 0;

    const DEFAULT_SOURCE = '';

    const OUTPUT_FORMAT = "
                        ---------------------
                        |   Drink   |  Money |
                        --------------------- 
                        |   Tea     |   %.2f |
                        ---------------------    
                        |   Coffee  |   %.2f |
                        ---------------------
                        | Chocolate |   %.2f |
                        ---------------------";

    protected static $defaultName = 'app:earnings';

    public function __construct(private RetrieveEarnings $retrieveEarnings)
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

        $retrieveEarningsResponse = $this->retrieveEarnings->__invoke();
        $retrieveReply= sprintf(self::OUTPUT_FORMAT, $retrieveEarningsResponse->tea
                        , $retrieveEarningsResponse->coffee
                        , $retrieveEarningsResponse->chocolate);

        $output->writeln($retrieveReply);
        return self::CODE_RESPONSE;
    }
}
