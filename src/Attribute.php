<?php

namespace Aviator\Html;

use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Validators\AttributeValidator;

class Attribute implements Renderable
{
    /** @var string */
    protected $name;

    /** @var string|null */
    protected $value;

    /**
     * Attribute constructor.
     * @param string $tag
     * @param string $name
     * @param string $value
     */
    public function __construct (string $tag, string $name, string $value = null)
    {
        $this->setName($tag, $name);
        $this->setValue($value);
    }

    /**
     * Static constructor.
     * @param string $tag
     * @param string $name
     * @param string $value
     * @return \Aviator\Html\Attribute
     */
    public static function make (string $tag, string $name, string $value = null)
    {
        return new self($tag, $name, $value);
    }

    /**
     * @param $tag
     * @param $name
     */
    public function setName ($tag, $name)
    {
        if (AttributeValidator::make($tag, $name)->validate()) {
            $this->name = $name;
        }
    }

    /**
     * @return string
     */
    public function getName () : string
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue (string $value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getValue ()
    {
        return $this->value;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        return is_null($this->value)
            ? $this->name
            : $this->name . '="' . $this->value . '"';
    }
}
