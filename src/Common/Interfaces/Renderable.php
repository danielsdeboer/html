<?php

namespace Aviator\Html\Common\Interfaces;

interface Renderable
{
    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render (): string;

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function __toString (): string;
}
