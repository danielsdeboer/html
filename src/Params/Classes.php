<?php

namespace Aviator\Html\Params;

use Aviator\Html\Common\Interfaces\Param;

class Classes implements Param
{
    /** @var array */
    private $classes;

    public function __construct (array $classes)
    {
        $this->classes = $classes;
    }

    public function value ()
    {
        return $this->classes;
    }
}
