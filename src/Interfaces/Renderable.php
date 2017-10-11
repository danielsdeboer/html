<?php

namespace Aviator\Html\Interfaces;

interface Renderable
{
    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string;
}
