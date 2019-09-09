<?php

namespace Aviator\Html\Params;

use Aviator\Html\Common\Interfaces\Param;

class Name implements Param
{
    /** @var string */
    private $value;

    public function __construct (string $value)
    {
        $this->value = $value;
    }

    public function value ()
    {
        return $this->value;
    }
}
