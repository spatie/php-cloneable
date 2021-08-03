<?php

namespace Spatie\Cloneable\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Cloneable\Cloneable;

class IterableCloneableTest extends TestCase
{
    /** @test */
    public function it_can_clone_iterable()
    {
        $collection = new Collection([1, 2, 3, 4], 1);
        $cloned = $collection->with(mode: 2);

        self::assertEquals([[1, 2, 3, 4], 2], [$cloned->items, $cloned->mode]);
    }
}

class Collection implements \IteratorAggregate
{
    use Cloneable;

    public function __construct(public readonly array $items, public readonly int $mode)
    {
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
