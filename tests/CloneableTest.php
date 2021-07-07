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

        $this->assertSame('a', $postA->title);
        $this->assertSame('b', $postB->title);
    }

    /** @test */
    public function it_can_clone_and_set_null()
    {
        $postA = new Post('a', 'Maria');

        $postB = $postA->with(author: null);

        $this->assertSame('Maria', $postA->author);
        $this->assertSame(null, $postB->author);
    }
}

class Post
{
    use Cloneable;

    public function __construct(
        public readonly string $title,
        public readonly ?string $author = null,
    ) {
    }
}
