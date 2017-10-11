<?php

namespace Aviator\Html\Interfaces;

interface Validator
{
    /**
     * Perform the validation.
     * @return bool
     */
    public function validate () : bool;
}
