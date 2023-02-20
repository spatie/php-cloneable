<?php

namespace Spatie\Cloneable;

use ReflectionClass;

trait Cloneable
{
    public function with(...$values): static
    {
        $refClass = new ReflectionClass(static::class);
        $clone = $refClass->newInstanceWithoutConstructor();

        foreach (get_object_vars($this) as $objectField => $objectValue) {
            $objectValue = array_key_exists($objectField, $values) ? $values[$objectField] : $objectValue;

            $declarationScope = $refClass->getProperty($objectField)->getDeclaringClass()->getName();
            if ($declarationScope === self::class) {
                $clone->$objectField = $objectValue;
            } else {
                (fn () => $this->$objectField = $objectValue)
                    ->bindTo($clone, $declarationScope)();
            }
        }

        return $clone;
    }
}
