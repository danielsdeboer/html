<?php

use Aviator\Html\Tag;

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

if (!function_exists('tag')) {
    /**
     * Get a tag instance.
     * @param string $name
     * @param array $classes
     * @param array $attributes
     * @return \Aviator\Html\Tag
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    function tag ($name, $classes = [], $attributes = [])
    {
        return new Tag($name, $classes, $attributes);
    }
}
