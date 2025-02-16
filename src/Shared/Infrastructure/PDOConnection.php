<?php

namespace Deliverea\CoffeeMachine\Shared\Infrastructure;
use PDO;

readonly class PDOConnection
{
    private PDO $pdo;
    public function __construct(string $dsn, string $user, string $pass)
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch as associative array
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    function getPDO() : PDO {
        return $this->pdo;
    }
}
