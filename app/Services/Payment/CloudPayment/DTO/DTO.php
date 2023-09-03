<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment\DTO;

abstract class DTO implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray():array
    {
        $out = [];
        foreach (self::properties() as $property) {
            $out[ucfirst($property->getName())] = $property->getValue($this);
        }

        return $out;
    }

    public static function fromArray(array $body): static
    {
        $constructor = [];
        foreach (self::properties() as $property) {
            $propertyName = $property->getName();

            if (!isset($body[ucfirst($propertyName)])) {
                continue;
            }

            $type = $property->getType();

            if (
                !$type instanceof \ReflectionNamedType &&
                !$type->isBuiltin()
            ) {
                continue;
            }

            $uncastedValue = $body[ucfirst($propertyName)];
            $value = match ($type->getName()) {
                'string' => (string)$uncastedValue,
                'float' => (float)$uncastedValue,
                'bool' => (bool)$uncastedValue
            };
            $constructor[$propertyName] = $value;
        }

        return new static(...$constructor);
    }

    /** @return \ReflectionProperty[] */
    private static function properties():array
    {
        return (new \ReflectionClass(static::class))
            ->getProperties(\ReflectionProperty::IS_PUBLIC);
    }
}
