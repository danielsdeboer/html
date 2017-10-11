<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Attribute;
use Aviator\Html\Bags\AttributeBag;
use PHPUnit\Framework\TestCase;

class AttributeBagTest extends TestCase
{
    /**
     * @test
     */
    public function creating_an_attribute_bag ()
    {
        $bag = new AttributeBag('input', []);

        $this->assertInstanceOf(AttributeBag::class, $bag);
    }

    /**
     * @test
     */
    public function creating_an_attribute_bag_with_static_constructor ()
    {
        $bag = AttributeBag::make('input', []);

        $this->assertInstanceOf(AttributeBag::class, $bag);
    }

    /**
     * @test
     */
    public function setting_attributes_and_getting_attributes ()
    {
        $bag = AttributeBag::make('input', ['name' => 'test']);

        $value = $bag->value('name');
        $attr = $bag->get('name');

        $this->assertSame('test', $value);
        $this->assertInstanceOf(Attribute::class, $attr);
    }

    /**
     * @test
     */
    public function setting_a_boolean_attribute ()
    {
        $bag = AttributeBag::make('input', ['disabled']);

        $this->assertSame('disabled', $bag->render());
    }

    /**
     * @test
     */
    public function rendering_the_bag ()
    {
        $bag = AttributeBag::make('input', ['name' => 'test', 'id' => 'test2']);

        $this->assertSame('name="test" id="test2"', $bag->render());
    }
}
