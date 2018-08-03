<?php

namespace Aviator\Html\Bags;

use Aviator\Html\Content;
use Aviator\Html\Interfaces\Renderable;

class ContentBag extends AbstractBag
{
    /** @var string */
    protected $name = 'content-bag';

    /**
     * Add many items. If the given array includes non-renderable items,
     * attempt to create a renderable with the string value of each.
     * @param array $items
     * @return $this
     */
    public function many (array $items)
    {
        foreach ($items as $item) {
            if ($item instanceof Renderable){
                $this->add($item);
            } else {
                $this->add(
                    Content::make(strval($item))
                );
            }
        }

        return $this;
    }

    /**
     * @param $carry
     * @param \Aviator\Html\Interfaces\Renderable $renderable
     * @return string
     */
    public function reduceCb ($carry, Renderable $renderable)
    {
        $carry .= $renderable->render();
        return $carry;
    }
}
