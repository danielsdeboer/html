<?php

namespace Aviator\Html\Params;

use Aviator\Html\Common\Interfaces\Param;

class Attrs implements Param
{
    /** @var array */
    private $attributes;

    public function __construct (array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function merge (Attrs $toMerge): void
    {
        $this->attributes = array_merge($this->attributes, $toMerge->value());
    }

    /**
     * @return array
     */
    public function value ()
    {
        return $this->attributes;
    }
}
