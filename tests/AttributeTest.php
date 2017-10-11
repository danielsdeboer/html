<?php

namespace Aviator\Html\Tests;

use Aviator\Html\Attribute;
use Aviator\Html\Exceptions\AttributeDoesNotExist;
use Aviator\Html\Exceptions\AttributeDoesNotMatchTag;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    /**
     * @test
     */
    public function creating_an_attribute ()
    {
        $attr = new Attribute('input', 'name', 'test');

        $this->assertInstanceOf(Attribute::class, $attr);
    }

    /**
     * @test
     */
    public function creating_an_attribute_with_static_constructor ()
    {
        $attr = Attribute::make('input', 'name', 'test');

        $this->assertInstanceOf(Attribute::class, $attr);
    }

    /**
     * @test
     */
    public function attribute_must_exist ()
    {
        $this->expectException(AttributeDoesNotExist::class);

        Attribute::make('input', 'garbage', 'value');
    }

    /**
     * @test
     */
    public function attribute_must_match_tag ()
    {
        $this->expectException(AttributeDoesNotMatchTag::class);

        Attribute::make('input', 'action', 'value');
    }

    /**
     * @test
     */
    public function rendering_an_attribute_with_a_value ()
    {
        $attr = Attribute::make('input', 'name', 'test');

        $this->assertSame('name="test"', $attr->render());
    }

    /**
     * @test
     */
    public function rendering_an_attribute_without_a_value ()
    {
        $attr = Attribute::make('input', 'disabled');

        $this->assertSame('disabled', $attr->render());
    }
}
