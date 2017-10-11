<?php

if (!function_exists('dd')) {
    /**
     * Die and dump.
     * @param array ...$args
     */
    function dd(...$args) {
        die(
            var_dump(...$args)
        );
    }
}

if (!function_exists('toSlug')) {
    /**
     * Generate a url-friendly slug from a string.
     * @param  string  $string
     * @return string
     */
    function toSlug($string)
    {
        return (new \Cocur\Slugify\Slugify())->slugify($string);
    }
}
