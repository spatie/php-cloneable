<?php

namespace Spatie\Cloneable\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Cloneable\Cloneable;

class InheritedCloneableTest extends TestCase
{
    /** @test */
    public function it_can_clone_inherited_properties()
    {
        $object1 = new InheritedCloneable(a: 'foo', b: 'bar');
        $object2 = $object1->with(b: 'baz');

        $this->assertEquals('foo', $object2->a);
        $this->assertEquals('baz', $object2->b);
    }
}

class InheritedCloneableBase
{
    use Cloneable;

    public function __construct(
        public readonly string $a,
    ) {
    }
}

class InheritedCloneable extends InheritedCloneableBase
{
    public function __construct(
        string $a,
        public readonly string $b
    ) {
        parent::__construct($a);
    }
}
