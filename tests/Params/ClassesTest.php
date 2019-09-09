<?php

namespace Aviator\Html\Tests\Params;

use Aviator\Html\Params\Classes;
use Aviator\Html\Tests\Common\UnitTestCase;
use Illuminate\Support\Str;

class ClassesTest extends UnitTestCase
{
    /** @test */
    public function merging (): void
    {
        $value1 = Str::random(16);
        $value2 = Str::random(16);

        $classes = new Classes([$value1]);
        $classes->merge(new Classes([$value2]));

        $expected = [$value1, $value2];

        $this->assertSame($expected, $classes->value());
    }
}
