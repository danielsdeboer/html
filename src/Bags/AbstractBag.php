<?php

namespace Aviator\Html\Bags;

use Aviator\Html\Interfaces\Bag;
use Aviator\Html\Interfaces\Renderable;

abstract class AbstractBag implements Renderable, Bag
{
    /** @var string */
    protected $name = 'abstract-bag';

    /** @var \Aviator\Html\Interfaces\Renderable[] */
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
     * Get a name.
     * @return string
     */
    public function getName () :string
    {
        return $this->name;
    }

    /**
     * Get an attribute instance by name.
     * @param $name
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
     * @param \Aviator\Html\Interfaces\Renderable $item
     * @return $this
     */
    public function add (Renderable $item)
    {
        $this->items[$item->getName()] = $item;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasItems () : bool
    {
        return count($this->items) > 0;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        return '' . array_reduce($this->items, [$this, 'reduceCallback']);
    }

    /**
     * @param array $items
     * @return mixed
     */
    abstract public function many (array $items);

    /**
     * @param $carry
     * @param $item
     * @return mixed
     */
    abstract public function reduceCallback($carry, Renderable $item);
}
