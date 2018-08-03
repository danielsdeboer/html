<?php

namespace Aviator\Html;

use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;
use Aviator\Html\Validators\AttributeValidator;

class Attribute implements Renderable
{
    use HasToString;

    /** @var string */
    protected $name;

    /** @var string|bool */
    protected $value;

    /**
     * Attribute constructor.
     * @param string $tag
     * @param string $name
     * @param string|bool $value
     */
    public function __construct (string $tag, string $name, $value = true)
    {
        $this->setName($tag, $name);
        $this->value = $value;
    }

    /**
     * Static constructor.
     * @param string $tag
     * @param string $name
     * @param string|bool $value
     * @return \Aviator\Html\Attribute
     */
    public static function make (string $tag, string $name, $value = true)
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
    public function getKey () : string
    {
        return $this->name;
    }

    /**
     * @return string|bool
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
        if ($this->value === false) {
            return '';
        }

        return $this->value === true
            ? $this->name
            : $this->name . '="' . $this->value . '"';
    }
}
