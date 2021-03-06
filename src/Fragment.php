<?php

namespace Aviator\Html;

use Aviator\Html\Common\Interfaces\Renderable;

class Fragment implements Renderable
{
    /** @var \Aviator\Html\Common\Interfaces\Renderable[] */
    private $renderables;

    /**
     * Constructor.
     * @param \Aviator\Html\Tag[] $renderables
     */
    public function __construct (array $renderables)
    {
        $this->renderables = [];

        foreach ($renderables as $renderable) {
            $this->addRenderable($renderable);
        }
    }

    /**
     * @param array $renderables
     * @return \Aviator\Html\Fragment
     */
    public static function make (array $renderables): Fragment
    {
        return new self($renderables);
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render (): string
    {
        return array_reduce(
            $this->renderables,
            /**
             * @param string $carry
             * @param \Aviator\Html\Common\Interfaces\Renderable $renderable
             * @return string
             */
            function ($carry, Renderable $renderable) {
                return $carry . $renderable->render();
            },
            ''
        );
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function __toString (): string
    {
        return $this->render();
    }

    /**
     * @param \Aviator\Html\Common\Interfaces\Renderable $renderable
     */
    private function addRenderable (Renderable $renderable): void
    {
        $this->renderables[] = $renderable;
    }
}
