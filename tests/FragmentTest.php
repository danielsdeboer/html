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

        $fragment = Fragment::make([$tag1, $tag2]);

        $expected = $tag1->render() . $tag2->render();
        $rendered = $fragment->__toString();

        $this->assertSame($expected, $rendered);
    }
}
