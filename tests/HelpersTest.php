<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Tests\Common\UnitTestCase;

class HelpersTest extends UnitTestCase
{
    /** @test */
    public function getting_a_slug ()
    {
        $string = 'some sentence &c^';

        $this->assertSame('some-sentence-c', toSlug($string));
    }
}
