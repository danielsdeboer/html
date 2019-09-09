<?php

namespace Aviator\Html;

use Aviator\Html\Common\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;

class ClassAttribute implements Renderable
{
    use HasToString;

    /** @var string */
    protected $name;

    /**
     * ClassAttribute constructor.
     * @param string $name
     */
    public function __construct (string $name)
    {
        $this->name = $name;
    }

    /**
     * Static constructor.
     * @param string $name
     * @return \Aviator\Html\ClassAttribute
     */
    public static function make (string $name)
    {
        return new self($name);
    }

    /**
     * @return string
     */
    public function getName (): string
    {
        return $this->name;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render (): string
    {
        return $this->name;
    }
}
