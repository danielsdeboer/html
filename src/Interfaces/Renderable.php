<?php

namespace Aviator\Html\Interfaces;

interface Renderable
{
    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string;

    /**
     * Get a name. All renderables are baggable and need a key.
     * @return string
     */
    public function getName () : string;
}
