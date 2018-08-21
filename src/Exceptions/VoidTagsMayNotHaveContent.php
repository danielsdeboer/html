<?php

namespace Aviator\Html\Exceptions;

use Exception;
use Throwable;

class VoidTagsMayNotHaveContent extends Exception
{
    /**
     * @param string $name
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct (string $name, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(self::makeMessage($name), $code, $previous);
    }

    /**
     * @param string $name
     * @return string
     */
    private static function makeMessage (string $name) : string
    {
        return sprintf(
            '"%s"is a void tag and may not have content.',
            $name
        );
    }
}
