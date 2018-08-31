<?php

namespace Aviator\Html;

use Aviator\Html\Interfaces\Renderable;

class Fragment implements Renderable
{
    /** @var \Aviator\Html\Tag[] */
    private $tags;

    /**
     * Constructor.
     * @param \Aviator\Html\Tag[] $tags
     */
    public function __construct (array $tags)
    {
        $this->tags = [];

        foreach ($tags as $tag) {
            if ($tag instanceof Tag) {
                $this->tags[] = $tag;
            }
        }
    }

    /**
     * @param array $tags
     * @return \Aviator\Html\Fragment
     */
    public static function make (array $tags) : Fragment
    {
        return new self($tags);
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        $fragment = '';

        foreach ($this->tags as $tag) {
            $fragment .= $tag->render();
        }

        return $fragment;
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function __toString () : string
    {
        return $this->render();
    }
}
