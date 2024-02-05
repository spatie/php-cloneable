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

    /** @test */
    public function it_can_set_uninitialised_values()
    {
        $postA = new Post('a');

        $postB = $postA->with(uninitialised: 'Now initialised');

        $this->assertFalse(isset($postA->uninitialised));
        $this->assertEquals('Now initialised', $postB->uninitialised);
    }

    /** @test */
    public function it_does_not_modify_static_properties()
    {
        $postA = new Post('a');
        Post::$counter = 42;

        $postA->with(title: 'b');

        $this->assertEquals(42, Post::$counter);
    }
}

class Post
{
    use Cloneable;

    public readonly string $uninitialised;
    public static int $counter = 0;

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
