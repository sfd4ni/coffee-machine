<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Shared\Infrastructure\Symfony;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;

class Container
{
    public static function getContainer(): ContainerBuilder
    {
        $rootPath = __DIR__ . '/../../../../';
        $dotEnd = new Dotenv();
        $dotEnd->loadEnv($rootPath . '.env');

        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator($rootPath . 'src/config'));
        $loader->load('services.yaml');
        $container->compile(true);

        return $container;
    }
}