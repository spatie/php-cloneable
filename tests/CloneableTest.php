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
}

class Post
{
    use Cloneable;

    public readonly string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function withTitle(string $title): self
    {
        return $this->with(title: $title);
    }
}
