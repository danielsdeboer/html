<?php

namespace Aviator\Html\Tests\Tag;

use Aviator\Html\Tag;
use PHPUnit\Framework\TestCase;

class TagConditionalTest extends TestCase
{
    /** @test */
    public function creating_a_conditional_tag_with_static_constructor ()
    {
        $tag = Tag::when(true, 'div');

        $this->assertInstanceOf(Tag::class, $tag);
    }

    /** @test */
    public function conditional_false_tags_dont_render ()
    {
        $tag = Tag::when(false, 'div');

        $this->assertSame('', $tag->render());
    }

    /** @test */
    public function conditional_true_tags_dont_render ()
    {
        $tag = Tag::when('truthy', 'div');

        $this->assertSame('<div></div>', $tag->render());
    }

    /** @test */
    public function conditional_accept_falsey_values ()
    {
        $tag = Tag::when(0, 'div');

        $this->assertSame('', $tag->render());
    }
}
