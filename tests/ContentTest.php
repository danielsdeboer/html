<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Content;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    /** @test */
    public function creating_content ()
    {
        $string = Str::random(16);
        $content = new Content($string);

        $this->assertInstanceOf(Content::class, $content);
        $this->assertSame(toSlug($string), $content->getName());
    }

    /** @test */
    public function creating_content_with_static_constructor ()
    {
        $content = Content::make('test');

        $this->assertInstanceOf(Content::class, $content);
    }

    /** @test */
    public function getting_an_unescaped_instance ()
    {
        $string = Content::unescaped('test>')->render();

        $this->assertContains('test>', $string);
    }

    /** @test */
    public function rendering_content ()
    {
        $content = Content::make('test');

        $this->assertSame('test', $content->render());
    }

    /** @test */
    public function content_is_escaped_by_default ()
    {
        $content = Content::make('<br>');

        $this->assertSame('&lt;br&gt;', $content->render());
    }

    /** @test */
    public function content_is_optionally_unescaped ()
    {
        $content = Content::make('<br>', false);

        $this->assertSame('<br>', $content->render());
    }

    /** @test */
    public function content_may_be_null ()
    {
        $content = Content::make(null);

        $this->assertSame('', $content->render());
    }
}
