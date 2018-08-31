<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Fragment;
use Aviator\Html\Tag;
use PHPUnit\Framework\TestCase;

class FragmentTest extends TestCase
{
    /** @test */
    public function creating_and_rendering_fragment ()
    {
        $tag1 = Tag::make('p');
        $tag2 = Tag::make('div');

        $fragment = new Fragment([$tag1, $tag2]);

        $expected = $tag1->render() . $tag2->render();
        $rendered = $fragment->render();

        $this->assertSame($expected, $rendered);
    }

    /** @test */
    public function non_tags_are_ignored ()
    {
        $tag1 = Tag::make('p');
        $tag2 = Tag::make('div');
        $some = 'string';

        $fragment = new Fragment([$tag1, $tag2, $some]);

        $expected = $tag1->render() . $tag2->render();
        $rendered = $fragment->render();

        $this->assertSame($expected, $rendered);
    }
}
