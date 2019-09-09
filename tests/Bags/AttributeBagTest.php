<?php

namespace Aviator\Html\Tests\Bags;

use Aviator\Html\Attribute;
use Aviator\Html\Bags\AttributeBag;
use PHPUnit\Framework\TestCase;

class AttributeBagTest extends TestCase
{
    /** @test */
    public function creating_an_attribute_bag ()
    {
        $bag = new AttributeBag('input', []);

        $this->assertInstanceOf(AttributeBag::class, $bag);
    }

    /** @test */
    public function creating_an_attribute_bag_with_static_constructor ()
    {
        $bag = AttributeBag::make('input', []);

        $this->assertInstanceOf(AttributeBag::class, $bag);
    }

    /** @test */
    public function setting_attributes_and_getting_attributes ()
    {
        $bag = AttributeBag::make('input', ['name' => 'test']);

        $value = $bag->value('name');
        $attr = $bag->get('name');

        $this->assertSame('test', $value);
        $this->assertInstanceOf(Attribute::class, $attr);
    }

    /** @test */
    public function setting_a_boolean_attribute ()
    {
        $bag = AttributeBag::make('input', ['disabled']);

        $this->assertSame('disabled', $bag->render());
    }

    /** @test */
    public function setting_a_boolean_attribute_with_value_true ()
    {
        $bag = new AttributeBag('input', ['disabled' => true]);

        $this->assertSame('disabled', $bag->render());
    }

    /** @test */
    public function setting_a_boolean_attribute_with_value_false ()
    {
        $bag = new AttributeBag('input', ['disabled' => false]);

        $this->assertSame('', $bag->render());
    }

    /** @test */
    public function rendering_the_bag ()
    {
        $bag = new AttributeBag('input', [
            'name' => 'test',
            'id' => 'test2',
            'disabled' => false,
            'autofocus' => true,
        ]);

        $this->assertSame(
            'name="test" id="test2" autofocus',
            $bag->render()
        );
    }
}
