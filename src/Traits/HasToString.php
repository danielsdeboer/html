<?php

namespace Aviator\Html\Traits;

/**
 * Trait HasToString
 * @package Aviator\Html\Traits
 * @mixin \Aviator\Html\Common\Interfaces\Renderable
 */
trait HasToString
{
    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function __toString () : string
    {
        return $this->render();
    }
}
