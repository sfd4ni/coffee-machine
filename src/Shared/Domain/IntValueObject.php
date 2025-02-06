<?php
declare(strict_types=1);

namespace Deliverea\Shared\Domain;

readonly abstract class IntValueObject implements ValueObject
{

    final private function __construct(private int $value)
    {
        $this->validate();
    }

    public static function from(int $value): static
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equalTo(IntValueObject $other): bool
    {
        return static::class === \get_class($other) && $this->value === $other->value;
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return static::class === \get_class($other) && $this->value > $other->value;
    }

    final public function jsonSerialize(): int
    {
        return $this->value;
    }

    abstract protected function validate() : void;
}