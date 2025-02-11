#!/usr/bin/env php
<?php

declare(strict_types=1);
// application.php

require __DIR__.'/vendor/autoload.php';

use Deliverea\CoffeeMachine\Drink\Infrastructure\Console\MakeDrinkCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new MakeDrinkCommand());

$application->run();
