<?php

namespace Aviator\Html\Validators;

use Aviator\Html\Exceptions\ValidationException;
use Aviator\Html\Interfaces\Validator;

class TagValidator implements Validator
{
    /** @var string */
    private $name;

    /** @var array */
    private $tags = [
        'a', 'abbr', 'acronym', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bdi', 'bdo', 'big',
        'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'datalist', 'dd',
        'del', 'details', 'dfn', 'div', 'dl', 'dt', 'em', 'embed', 'fieldset', 'figcaption', 'figure', 'footer',
        'form', 'frame', 'frameset', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html',
        'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend', 'li', 'link', 'map', 'mark', 'menu',
        'meta', 'meter', 'nav', 'noframes', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'p', 'param',
        'pre', 'progress', 'q', 'rp', 'rt', 'ruby', 'samp', 'script', 'section', 'select', 'small', 'source', 'span',
        'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'time',
        'title', 'tr', 'tt', 'ul', 'var', 'video', 'wbr',
    ];

    /**
     * TagValidator constructor.
     * @param string $name
     */
    public function __construct (string $name)
    {
        $this->name = $name;
    }

    /**
     * Static constructor
     * @param string $name
     * @return \Aviator\Html\Validators\TagValidator
     */
    public static function make (string $name)
    {
        return new self($name);
    }

    /**
     * Perform the validation.
     * @return bool
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public function validate () : bool
    {
        if (in_array($this->name, $this->tags)) {
            return true;
        }

        throw new ValidationException('"' . $this->name . '" is not a valid tag.');
    }
}
