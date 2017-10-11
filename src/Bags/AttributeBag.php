<?php

namespace Aviator\Html\Bags;

use Aviator\Html\Attribute;
use Aviator\Html\Interfaces\Renderable;

class AttributeBag extends AbstractBag
{
    protected $name = 'attribute-bag';

    /** @var string */
    protected $tag;

    /**
     * AttributeBag constructor.
     * @param string $tag
     * @param array $items
     */
    public function __construct (string $tag, array $items)
    {
        $this->tag = $tag;

        parent::__construct($items);
    }

    /**
     * Get an attribute value by name.
     * @param $name
     * @return string|null
     */
    public function value ($name)
    {
        /** @var \Aviator\Html\Attribute $attribute */
        $attribute = $this->get($name);

        return $attribute
            ? $attribute->getValue()
            : null;
    }

    /**
     * Set multiple attributes.
     * @param array $items
     * @return $this
     */
    public function many (array $items)
    {
        foreach ($items as $name => $value) {
            /*
             * If the key is numeric create a boolean attribute.
             */
            if (is_numeric($name)) {
                $this->add(
                    Attribute::make($this->tag, $value)
                );
            } else {
                $this->add(
                    Attribute::make($this->tag, $name, $value)
                );
            }
        }

        return $this;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () :string
    {
        return implode(
            ' ',
            array_map(function (Renderable $item) {
                return $item->render();
            }, $this->items)
        );
    }

    /**
     * Attribute reducer callback.
     * @param $carry
     * @param \Aviator\Html\Interfaces\Renderable $item
     * @return string
     */
    public function reduceCallback ($carry, Renderable $item)
    {
        $carry .= ' ' . $item->render();
        return $carry;
    }
}
