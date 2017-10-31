<?php

namespace Aviator\Html;

use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;

class Content implements Renderable
{
    use HasToString;

    /**
     * @var string
     */
    private $content;

    /**
     * Content constructor.
     * @param string $content
     */
    public function __construct (string $content)
    {
        $this->content = $content;
    }

    /**
     * Static constructor.
     * @param string $content
     * @return \Aviator\Html\Content
     */
    public static function make (string $content)
    {
        return new self($content);
    }

    /**
     * @return string
     */
    public function getName () : string
    {
        return substr(toSlug($this->content), 0, 45);
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        return htmlspecialchars($this->content, ENT_QUOTES, 'UTF-8', false);
    }
}
