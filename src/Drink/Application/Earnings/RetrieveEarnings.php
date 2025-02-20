<?php


namespace Deliverea\CoffeeMachine\Drink\Application\Earnings;


use Deliverea\CoffeeMachine\Drink\Domain\DrinkRepository;
use Deliverea\CoffeeMachine\Drink\Domain\DrinkType;

class RetrieveEarnings
{

    public function __construct(private DrinkRepository $drinkRepository)
    {
        
    }

    public function __invoke(): RetrieveEarningsResponse
    {
        $retrieveEarningsResponse = new RetrieveEarningsResponse();
        foreach($this->drinkRepository->getAll() as $drink) {
            switch ($drink->drinkType) {
                case DrinkType::Chocolate:
                    $retrieveEarningsResponse->chocolate += $drink->price->value();
                    break;
                case DrinkType::Tea:
                    $retrieveEarningsResponse->tea += $drink->price->value();
                    break;
                case DrinkType::Coffee:
                    $retrieveEarningsResponse->coffee += $drink->price->value();
                    break;
                default:
            }
        }
        return $retrieveEarningsResponse;
    }
}