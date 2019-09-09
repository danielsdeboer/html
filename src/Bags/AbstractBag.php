<?php

namespace Aviator\Html\Bags;

use Aviator\Html\Common\Interfaces\Bag;
use Aviator\Html\Common\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;

abstract class AbstractBag implements Renderable, Bag
{
    use HasToString;

    /** @var \Aviator\Html\Common\Interfaces\Renderable[] */
    protected $items = [];

    /**
     * AbstractBag constructor.
     * @param array $items
     */
    public function __construct (array $items)
    {
        $this->many($items);
    }

    /**
     * AbstractBag static constructor.
     * @param array $args
     * @return mixed
     */
    public static function make (...$args)
    {
        $class = get_called_class();

        return new $class(...$args);
    }

    /**
     * Get an attribute instance by name.
     * @param string $name
     * @return Renderable|null
     */
    public function get ($name)
    {
        return array_key_exists($name, $this->items)
            ? $this->items[$name]
            : null;
    }

    /**
     * Add a single renderable item.
     * @param \Aviator\Html\Common\Interfaces\Renderable $item
     * @return \Aviator\Html\Bags\AbstractBag
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function add (Renderable $item)
    {
        // Some renderables are unique and callable by key (eg Attribute)
        if (method_exists($item, 'getKey')) {
            $this->items[$item->getKey()] = $item;
        } else {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasItems (): bool
    {
        return count($this->items) > 0;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render (): string
    {
        return '' . array_reduce($this->items, [$this, 'reduceCb']);
    }

    /**
     * @param array $items
     * @return mixed
     */
    abstract public function many (array $items);

    /**
     * @param string $carry
     * @param \Aviator\Html\Common\Interfaces\Renderable $item
     * @return string
     */
    abstract public function reduceCb($carry, Renderable $item);
}
