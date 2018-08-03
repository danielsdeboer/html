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
     * Set multiple attributes. Attributes with a value of 'false' will be
     * ignored.
     * @param array $items
     * @return $this
     */
    public function many (array $items)
    {
        foreach ($items as $name => $value) {
            if (is_bool($value)) {
                $this->addBooleanAttribute($name, $value);
            } elseif (is_numeric($name)) {
                $this->addBooleanAttribute($value, true);
            } else {
                $this->addAttribute($name, $value);
            }
        }

        return $this;
    }

    /**
     * @param string $name
     * @param bool $value
     */
    private function addBooleanAttribute (string $name, bool $value)
    {
        $this->add(
            new Attribute($this->tag, $name, $value)
        );
    }

    /**
     * @param string $name
     * @param string $value
     */
    private function addAttribute (string $name, string $value)
    {
        $this->add(
            new Attribute($this->tag, $name, $value)
        );
    }

    /**
     * An array of rendered attributes. This includes empty strings for
     * boolean attributes set to 'false'.
     * @return array
     */
    private function renderedParts () : array
    {
        return array_filter(
            array_map([$this, 'renderCb'], $this->items)
        );
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        return implode(' ', $this->renderedParts());
    }

    /**
     * Attribute reducer callback.
     * @param $carry
     * @param \Aviator\Html\Interfaces\Renderable $item
     * @return string
     */
    public function reduceCb ($carry, Renderable $item)
    {
        $carry .= ' ' . $item->render();

        return $carry;
    }

    /**
     * @param \Aviator\Html\Interfaces\Renderable $item
     * @return string
     */
    public function renderCb (Renderable $item)
    {
        return $item->render();
    }
}
