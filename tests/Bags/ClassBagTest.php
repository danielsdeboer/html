<?php

namespace Aviator\Html\Tests\Bags;

use Aviator\Html\Bags\ClassBag;
use PHPUnit\Framework\TestCase;

class ClassBagTest extends TestCase
{
    /** @test */
    public function creating_a_class_bag ()
    {
        $bag = new ClassBag([]);

        $this->assertInstanceOf(ClassBag::class, $bag);
    }

    /** @test */
    public function creating_a_class_bag_with_static_constructor ()
    {
        $bag = ClassBag::make([]);

        $this->assertInstanceOf(ClassBag::class, $bag);
    }

    /** @test */
    public function creating_a_class_bag_with_a_string ()
    {
        $bag = ClassBag::make('string');

        $this->assertSame('class="string"', $bag->render());
    }

    /** @test */
    public function creating_a_class_bag_with_an_array ()
    {
        $bag = ClassBag::make(['string1', 'string2']);

        $this->assertSame('class="string1 string2"', $bag->render());
    }

    /** @test */
    public function rendering_a_class_bag ()
    {
        $bag = ClassBag::make(['class1', 'class2']);

        $this->assertSame('class="class1 class2"', $bag->render());
    }
}
