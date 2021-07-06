<?php

namespace Spatie\Cloneable;

use ReflectionClass;

trait Cloneable
{
    public function with(...$values): static
    {
        $clone = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        foreach ($this as $objectField => $objectValue) {
            $objectValue = $values[$objectField] ?? $objectValue;

            $clone->$objectField = $objectValue;
        }

        return $clone;
    }
}
