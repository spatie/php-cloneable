<?php

namespace Spatie\Cloneable\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Cloneable\Cloneable;

class CloneableTest extends TestCase
{
    /** @test */
    public function it_can_clone()
    {
        $postA = new Post('a');

        $postB = $postA->with(title: 'b');

        $this->assertEquals('a', $postA->title);
        $this->assertEquals('b', $postB->title);
    }

    /** @test */
    public function it_works_with_null_values()
    {
        $postA = new Post(title: 'a', nullable: 'a');

        $postB = $postA->with(nullable: null);

        $this->assertNull($postB->nullable);
    }
}

class Post
{
    use Cloneable;

    public function __construct(
        public readonly string $title,
        public readonly ?string $nullable = null,
    ) {
    }

    public function withTitle(string $title): self
    {
        return $this->with(title: $title);
    }
}
