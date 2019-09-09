<?php

namespace Aviator\Html\Common\Interfaces;

interface Node extends Renderable
{
    public function setName (string $name);
    public function getName (): string;
    public function addAttribute (array $attributes);
    public function isVoid (): bool;

    /**
     * @param array|string|\Aviator\Html\Common\Interfaces\Renderable $contents
     */
    public function with ($contents);

    /**
     * Get an attribute value by name.
     * @return string|bool|null
     */
    public function attribute (string $name);

    /**
     * @param string|\Aviator\Html\Common\Interfaces\Renderable $content
     */
    public function addContent ($content);

    /**
     * @param string|string[] $class
     */
    public function addClass ($class);
}
