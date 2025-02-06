<?php
declare(strict_types=1);

namespace Deliverea\Shared\Domain;

interface ValueObject extends \JsonSerializable
{
    public function value(): mixed;
}