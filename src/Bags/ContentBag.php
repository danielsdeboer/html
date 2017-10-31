<?php

namespace Aviator\Html\Bags;

use Aviator\Html\Content;
use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;

class ContentBag extends AbstractBag
{
    /** @var string */
    protected $name = 'content-bag';

    /**
     * @param array $items
     * @return $this
     */
    public function many (array $items)
    {
        foreach ($items as $item) {
            if (is_string($item) || is_null($item)) {
                $this->add(
                    Content::make($item)
                );
            } else {
                $this->add($item);
            }
        }

        return $this;
    }

    /**
     * @param $carry
     * @param \Aviator\Html\Interfaces\Renderable $renderable
     * @return string
     */
    public function reduceCallback ($carry, Renderable $renderable)
    {
        $carry .= $renderable->render();
        return $carry;
    }
}
