<?php
/**
 * Created by PhpStorm.
 * User: ddeboer
 * Date: 10/10/2017
 * Time: 2:36 PM
 */

namespace Aviator\Html\Tests;

use Aviator\Html\Bags\ContentBag;
use Aviator\Html\Tag;
use PHPUnit\Framework\TestCase;

class ContentBagTest extends TestCase
{
    /**
     * @test
     */
    public function creating_content_bag ()
    {
        $bag = new ContentBag([]);

        $this->assertInstanceOf(ContentBag::class, $bag);
    }

    /**
     * @test
     */
    public function creating_content_bag_with_static_constructor ()
    {
        $bag = ContentBag::make([]);

        $this->assertInstanceOf(ContentBag::class, $bag);
    }

    /**
     * @test
     */
    public function rendering_string_content ()
    {
        $bag = ContentBag::make(['here is some string content']);

        $this->assertSame('here is some string content', $bag->render());
    }

    /**
     * @test
     */
    public function rendering_tag_content ()
    {
        $tag = Tag::make('div');
        $bag = ContentBag::make([$tag]);

        $this->assertSame('<div></div>', $bag->render());
    }

    /**
     * @test
     */
    public function rendering_multiple_tag_content ()
    {
        $bag = ContentBag::make([
            Tag::make('li')->with('content1'),
            Tag::make('li')->with('content2'),
        ]);

        $this->assertSame('<li>content1</li><li>content2</li>', $bag->render());
    }

    /**
     * @test
     */
    public function rendering_mixed_content ()
    {
        $tag = Tag::make('div');
        $string = 'some string';
        $bag = ContentBag::make([$tag, $string]);

        $this->assertSame('<div></div>some string', $bag->render());
    }
}
