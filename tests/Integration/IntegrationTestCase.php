<?php

declare(strict_types=1);

namespace Deliverea\CoffeeMachine\Tests\Integration;


use Deliverea\CoffeeMachine\Shared\Infrastructure\Symfony\Container;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class IntegrationTestCase extends TestCase
{
    protected Application $application;
    protected ContainerBuilder $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->application = new Application();
        $this->container = Container::getContainer();
    }

    protected function tearDown(): void
    {

        parent::tearDown();
    }
}
