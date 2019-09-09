<?php

namespace Aviator\Html\Common\Interfaces;

interface Validator
{
    /**
     * Perform the validation.
     * @return bool
     */
    public function validate (): bool;
}
