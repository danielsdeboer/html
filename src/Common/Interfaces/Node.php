<?php

namespace Aviator\Html\Common\Interfaces;

interface Node extends Renderable
{
    public function setName (string $name);
    public function getName (): string;
    public function addContent ($content);
    public function addAttribute (array $attributes);
    public function attribute ($name);
    public function with ($contents);
    public function isVoid (): bool;

    /**
     * @param string|string[] $class
     */
    public function addClass ($class);
}
