<?php

namespace Aviator\Html\Bags;

use Aviator\Html\ClassAttribute;
use Aviator\Html\Interfaces\Renderable;

class ClassBag extends AbstractBag
{
    /** @var string */
    protected $name = 'class-bag';

    /**
     * ClassBag constructor.
     * @param mixed $items
     */
    public function __construct ($items)
    {
        if (!is_array($items)) {
            $items = array_filter([$items]);
        }

        parent::__construct($items);
    }

    /**
     * @param array $items
     * @return $this
     */
    public function many (array $items)
    {
        foreach ($items as $item) {
            $this->add(
              ClassAttribute::make($item)
            );
        }

        return $this;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        return $this->hasItems()
            ? 'class="' . trim(array_reduce($this->items, [$this, 'reduceCb'])) . '"'
            : '';
    }

    /**
     * @param string $carry
     * @param \Aviator\Html\Interfaces\Renderable $renderable
     * @return string
     */
    public function reduceCb ($carry, Renderable $renderable)
    {
        /**
         * @noinspection PhpUndefinedMethodInspection
         * @psalm-suppress UndefinedInterfaceMethod
         */
        $carry .= $renderable->getName() . ' ';

        return $carry;
    }
}
