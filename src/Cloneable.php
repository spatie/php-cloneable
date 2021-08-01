<?php

namespace Spatie\Cloneable;

use ReflectionClass;

trait Cloneable
{
    public function with(...$values): static
    {
        $clone = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        foreach (get_object_vars($this) as $objectField => $objectValue) {
            $objectValue = array_key_exists($objectField, $values) ? $values[$objectField] : $objectValue;

            $clone->$objectField = $objectValue;
        }

        return $clone;
    }
}
