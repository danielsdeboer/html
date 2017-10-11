<?php

namespace Aviator\Html;

class Delegator
{
    /** @var mixed */
    protected $items;

    /** @var \Closure  */
    protected $callback;

    /**
     * Delegator constructor.
     * @param $items
     * @param \Closure $callback
     */
    public function __construct ($items, \Closure $callback)
    {
        $this->items = $items;
        $this->callback = $callback;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get ($name)
    {
        return call_user_func($this->callback, $this->items, $name);
    }
}
