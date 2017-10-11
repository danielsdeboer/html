<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Exceptions\ValidationException;
use Aviator\Html\Exceptions\VoidTagsMayNotHaveContentException;
use Aviator\Html\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    /**
     * @test
     */
    public function creating_a_tag ()
    {
        $tag = new Tag('div');

        $this->assertInstanceOf(Tag::class, $tag);
    }

    /**
     * @test
     */
    public function creating_a_tag_via_static_constructor ()
    {
        $tag = Tag::make('div');

        $this->assertInstanceOf(Tag::class, $tag);
    }

    /**
     * @test
     */
    public function creating_an_invalid_tag_throws_an_error ()
    {
        $this->expectException(ValidationException::class);

        $tag = Tag::make('garbage');
    }

    /**
     * @test
     */
    public function rendering_a_tag ()
    {
        $tag = Tag::make('div');

        $string = $tag->render();

        $this->assertSame('<div></div>', $string);
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_an_attribute ()
    {
        $tag = Tag::make('div', [], ['id' => 'identifier']);

        $string = $tag->render();

        $this->assertSame('<div id="identifier"></div>', $string);
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_multiple_attributes ()
    {
        $tag = Tag::make('div', [], [
            'id' => 'identifier',
            'title' => 'A Div'
        ]);

        $this->assertSame('<div id="identifier" title="A Div"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_a_class ()
    {
        $tag = Tag::make('div', 'test-class');

        $this->assertSame('<div class="test-class"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_multiple_classes ()
    {
        $tag = Tag::make('div', ['test-class', 'another-class']);

        $this->assertSame('<div class="test-class another-class"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_string_content ()
    {
        $tag = Tag::make('div')->with('some content');

        $this->assertSame('<div>some content</div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_renderable_content ()
    {
        $content = Tag::make('p', [], ['id' => 'text']);
        $tag = Tag::make('div')->with($content);

        $this->assertSame('<div><p id="text"></p></div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_multiple_renderables ()
    {
        $tag = Tag::make('ul')->with([
            Tag::make('li')->with('content1'),
            Tag::make('li')->with('content2'),
        ]);

        $this->assertSame('<ul><li>content1</li><li>content2</li></ul>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_mixed_content ()
    {
        $content1 = Tag::make('p');
        $content2 = 'some text';
        $tag = Tag::make('div')->with(compact('content1', 'content2'));

        $this->assertSame('<div><p></p>some text</div>', $tag->render());
    }

    /**
     * @test
     */
    public function rendering_nested_content ()
    {
        $content1 = Tag::make('p', [], ['id' => '1'])->with(
            Tag::make('small', [], ['id' => '2'])->with(
                'some text'
            )
        );

        $tag = Tag::make('div', [], ['id' => '0'])->with($content1);

        $this->assertSame(
            '<div id="0"><p id="1"><small id="2">some text</small></p></div>',
            $tag->render()
        );
    }

    /**
     * @test
     */
    public function rendering_a_tag_with_classes_attributes_and_content ()
    {
        $tag = Tag::make('select', ['select'], ['name' => 'something'])->with([
            Tag::make('option', [], ['value' => 'some value', 'disabled'])
        ]);

        $this->assertSame(
            '<select class="select" name="something"><option value="some value" disabled></option></select>',
            $tag->render()
        );
    }

    /**
     * @test
     */
    public function rendering_a_void_tag ()
    {
        $tag = Tag::make('input');

        $this->assertSame('<input>', $tag->render());
    }

    /**
     * @test
     */
    public function void_tags_may_not_have_content ()
    {
        $this->expectException(VoidTagsMayNotHaveContentException::class);

        $tag = Tag::make('input')->with('content');
    }

    /**
     * @test
     */
    public function adding_a_class ()
    {
        $tag = Tag::make('div');

        $tag->addClass('some-class');

        $this->assertSame('<div class="some-class"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function adding_multiple_classes ()
    {
        $tag = Tag::make('div');

        $tag->addClass('class1');
        $tag->addClass('class2');
        $tag->addClass([
           'class3',
           'class4'
        ]);

        $this->assertSame('<div class="class1 class2 class3 class4"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function adding_an_attribute ()
    {
        $tag = Tag::make('div');

        $tag->addAttribute(['id' => 'some-id']);

        $this->assertSame('<div id="some-id"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function adding_multiple_attributes ()
    {
        $tag = Tag::make('div');

        $tag->addAttribute(['id' => 'some-id']);
        $tag->addAttribute(['title' => 'A Title']);

        $this->assertSame('<div id="some-id" title="A Title"></div>', $tag->render());
    }

    /**
     * @test
     */
    public function getting_an_attribute_value ()
    {
        $tag = Tag::make('div', [], ['title' => 'test']);

        $this->assertSame('test', $tag->attribute('title'));
    }

    /**
     * @test
     */
    public function getting_a_boolean_attribute_value ()
    {
        $tag = Tag::make('input', [], ['disabled']);

        $this->assertSame(true, $tag->attribute('disabled'));
    }

    /**
     * @test
     */
    public function getting_a_nonexistent_attribute_value ()
    {
        $tag = Tag::make('input');

        $this->assertSame(null, $tag->attribute('disabled'));
    }

    /**
     * @test
     */
    public function getting_attributes_via_the_magic_attributes_property ()
    {
        $tag = Tag::make('input', 'input', ['name' => 'test1']);

        $this->assertSame('test1', $tag->attributes->name);
    }
}
