<?php
/**
 * Created by PhpStorm.
 * User: ddeboer
 * Date: 10/10/2017
 * Time: 2:36 PM
 */

namespace Aviator\Html\Tests;

use Aviator\Html\Content;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    /** @test */
    public function creating_content ()
    {
        $content = new Content('test');

        $this->assertInstanceOf(Content::class, $content);
    }

    /** @test */
    public function creating_content_with_static_constructor ()
    {
        $content = Content::make('test');

        $this->assertInstanceOf(Content::class, $content);
    }

    /** @test */
    public function rendering_content ()
    {
        $content = Content::make('test');

        $this->assertSame('test', $content->render());
    }
}
