#!/usr/bin/env php
<?php

declare(strict_types=1);
// application.php

require __DIR__.'/vendor/autoload.php';

use Deliverea\CoffeeMachine\Drink\Infrastructure\Console\EarningsCommand;
use Deliverea\CoffeeMachine\Drink\Infrastructure\Console\MakeDrinkCommand;
use Deliverea\CoffeeMachine\Shared\Infrastructure\Symfony\Container;
use Symfony\Component\Console\Application;

$container = Container::getContainer();

$application = new Application();

$application->add(new MakeDrinkCommand());
$application->add($container->get(EarningsCommand::class));

$application->run();
