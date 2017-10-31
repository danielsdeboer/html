<?php

namespace Aviator\Html;

use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;

class Content implements Renderable
{
    use HasToString;

    /** @var string */
    private $content;

    /** @var bool */
    private $escaped;

    /**
     * Content constructor.
     * @param string $content
     * @param bool $escaped
     */
    public function __construct (string $content, bool $escaped = true)
    {
        $this->content = $content;
        $this->escaped = $escaped;
    }

    /**
     * Static constructor.
     * @param string $content
     * @param bool $escaped
     * @return \Aviator\Html\Content
     */
    public static function make (string $content, bool $escaped = true)
    {
        return new self($content, $escaped);
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
        return $this->escaped
            ? $this->escapedContent()
            : $this->content;
    }

    /**
     * @return string
     */
    protected function escapedContent ()
    {
        return htmlspecialchars($this->content, ENT_QUOTES, 'UTF-8', false);
    }
}
