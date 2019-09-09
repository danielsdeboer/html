<?php

namespace Aviator\Html\Tests\Tag;

use Aviator\Html\Params\Classes;
use Aviator\Html\Params\Name;
use Aviator\Html\Params\Attrs;
use Aviator\Html\Tag;
use PHPUnit\Framework\TestCase;

class TagVariadicParamTest extends TestCase
{
    /** @test */
    public function creating_a_tag_with_just_a_name ()
    {
        // Props and classes can be completely omitted.
        $tag = Tag::of(new Name('p'));

        $expected = '<p></p>';

        $this->assertSame($expected, $tag->render());
    }

    /** @test */
    public function creating_a_tag_with_classes ()
    {
        $tag = Tag::of(new Name('p'), new Classes(['test']));
        $expected = '<p class="test"></p>';

        $this->assertSame($expected, $tag->render());
    }

    /** @test */
    public function creating_a_tag_with_props ()
    {
        $props = new Attrs(['title' => 'test']);
        $tag = Tag::of(new Name('p'), $props);
        $expected = '<p title="test"></p>';

        $this->assertSame($expected, $tag->render());
    }

    /** @test */
    public function creating_a_tag_with_props_and_classes ()
    {
        $name = new Name('p');
        $props = new Attrs(['title' => 'test-title']);
        $classes = new Classes(['test-class']);

        // The order of props and classes doesn't matter.
        $tag1 = Tag::of($name, $props, $classes);
        $tag2 = Tag::of($name, $classes, $props);
        $expected = '<p class="test-class" title="test-title"></p>';

        $this->assertSame($expected, $tag1->render());
        $this->assertSame($tag1->render(), $tag2->render());
    }
}
