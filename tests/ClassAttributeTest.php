<?php

namespace Aviator\Html\Tests;

use Aviator\Html\ClassAttribute;
use PHPUnit\Framework\TestCase;

class ClassAttributeTest extends TestCase
{
    /** @test */
    public function creating_with_static_constructor ()
    {
        $class = ClassAttribute::make('some-class');

        $this->assertInstanceOf(ClassAttribute::class, $class);
    }

    /** @test */
    public function rendering_the_attribute ()
    {
        $class = ClassAttribute::make('some-class');

        $this->assertSame('some-class', $class->render());
    }
}
