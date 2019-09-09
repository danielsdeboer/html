<?php

namespace Aviator\Html\Tests\Params;

use Aviator\Html\Params\Attrs;
use Aviator\Html\Tests\Common\UnitTestCase;
use Illuminate\Support\Str;

class AttrsTest extends UnitTestCase
{
    /** @test */
    public function merging (): void
    {
        $key1 = Str::random(8);
        $key2 = Str::random(8);
        $value1 = Str::random(16);
        $value2 = Str::random(16);

        $attrs = new Attrs([$key1 => $value1]);
        $attrs->merge(new Attrs([$key2 => $value2]));

        $expected = [$key1 => $value1, $key2 => $value2];

        $this->assertSame($expected, $attrs->value());
    }

    /** @test */
    public function getting_a_value (): void
    {
        $key = Str::random(8);
        $value = Str::random(16);

        $attrs = new Attrs([$key => $value]);

        $this->assertSame($value, $attrs->get($key));
    }

    /** @test */
    public function check_if_a_key_exists (): void
    {
        $key = Str::random(8);
        $value = Str::random(16);

        $attrs = new Attrs([$key => $value]);

        $this->assertTrue($attrs->has($key));
        $this->assertFalse($attrs->has(Str::random(8)));
    }
}
