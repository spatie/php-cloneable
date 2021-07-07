<?php

namespace Spatie\Cloneable;

use ReflectionClass;

trait Cloneable
{
    public function with(...$values): static
    {
        $clone = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        foreach ($this as $objectField => $objectValue) {
            if (array_key_exists($objectField, $values)) {
                $objectValue = $values[$objectField];
            }

            $clone->$objectField = $objectValue;
        }

        return $clone;
    }
}
