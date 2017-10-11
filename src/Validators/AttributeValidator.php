<?php

namespace Aviator\Html\Validators;

use Aviator\Html\Exceptions\AttributeDoesNotExist;
use Aviator\Html\Exceptions\AttributeDoesNotMatchTag;
use Aviator\Html\Interfaces\Validator;

class AttributeValidator implements Validator
{
    /** @var string */
    protected $tag;

    /** @var string */
    protected $attribute;

    /** @var array */
    protected $validAttributes = [
        'accept' => [
            'matches' => ['form', 'input']
        ],
        'accept-charset' => [
            'matches' => ['form']
        ],
        'accesskey' => [
            'matches' => ['*']
        ],
        'action' => [
            'matches' => ['form']
        ],
        'align' => [
            'matches' => ['applet', 'caption', 'col', 'colgroup',  'hr', 'iframe', 'img', 'table', 'tbody',  'td',  'tfoot' , 'th', 'thead', 'tr']
        ],
        'alt' => [
            'matches' => ['applet', 'area', 'img', 'input']
        ],
        'async' => [
            'matches' => ['script']
        ],
        'autocomplete' => [
            'matches' => ['form', 'input']
        ],
        'autofocus' => [
            'matches' => ['button', 'input', 'keygen', 'select', 'textarea']
        ],
        'autoplay' => [
            'matches' => ['audio', 'video']
        ],
        'autosave' => [
            'matches' => ['input']
        ],
        'border' => [
            'matches' => ['img', 'object', 'table']
        ],
        'buffered' => [
            'matches' => ['audio', 'video']
        ],
        'challenge' => [
            'matches' => ['keygen']
        ],
        'charset' => [
            'matches' => ['meta', 'script']
        ],
        'checked' => [
            'matches' => ['command', 'input']
        ],
        'cite' => [
            'matches' => ['blockquote', 'del', 'ins', 'q']
        ],
        'class' => [
            'matches' => ['*']
        ],
        'code' => [
            'matches' => ['applet']
        ],
        'codebase' => [
            'matches' => ['applet']
        ],
        'cols' => [
            'matches' => ['textarea']
        ],
        'colspan' => [
            'matches' => ['td', 'th']
        ],
        'content' => [
            'matches' => ['meta']
        ],
        'contenteditable' => [
            'matches' => ['*']
        ],
        'contextmenu' => [
            'matches' => ['*']
        ],
        'controls' => [
            'matches' => ['audio', 'video']
        ],
        'coords' => [
            'matches' => ['area']
        ],
        'crossorigin' => [
            'matches' => ['audio', 'img', 'link', 'script', 'video']
        ],
        'data' => [
            'matches' => ['object']
        ],
        'data-*' => [
            'matches' => ['*']
        ],
        'datetime' => [
            'matches' => ['del', 'ins', 'time']
        ],
        'default' => [
            'matches' => ['track']
        ],
        'defer' => [
            'matches' => ['script']
        ],
        'dir' => [
            'matches' => ['*']
        ],
        'dirname' => [
            'matches' => ['input', 'textarea']
        ],
        'disabled' => [
            'matches' => ['button', 'command', 'fieldset', 'input', 'keygen', 'optgroup', 'option', 'select', 'textarea']
        ],
        'download' => [
            'matches' => ['a', 'area']
        ],
        'draggable' => [
            'matches' => ['*']
        ],
        'dropzone' => [
            'matches' => ['*']
        ],
        'enctype' => [
            'matches' => ['form']
        ],
        'for' => [
            'matches' => ['label', 'output']
        ],
        'form' => [
            'matches' => ['button', 'fieldset', 'input', 'keygen', 'label', 'meter', 'object', 'output', 'progress', 'select', 'textarea']
        ],
        'formaction' => [
            'matches' => ['input', 'button']
        ],
        'headers' => [
            'matches' => ['td', 'th']
        ],
        'height' => [
            'matches' => ['canvas', 'embed', 'iframe', 'img', 'input', 'object', 'video']
        ],
        'hidden' => [
            'matches' => ['*']
        ],
        'high' => [
            'matches' => ['meter']
        ],
        'href' => [
            'matches' => ['a', 'area', 'base', 'link']
        ],
        'hreflang' => [
            'matches' => ['a', 'area', 'link']
        ],
        'http-equiv' => [
            'matches' => ['meta']
        ],
        'icon' => [
            'matches' => ['command']
        ],
        'id' => [
            'matches' => ['*']
        ],
        'integrity' => [
            'matches' => ['link', 'script']
        ],
        'ismap' => [
            'matches' => ['img']
        ],
        'itemprop' => [
            'matches' => ['*']
        ],
        'keytype' => [
            'matches' => ['keygen']
        ],
        'kind' => [
            'matches' => ['track']
        ],
        'label' => [
            'matches' => ['track']
        ],
        'lang' => [
            'matches' => ['*']
        ],
        'language' => [
            'matches' => ['script']
        ],
        'list' => [
            'matches' => ['input']
        ],
        'loop' => [
            'matches' => ['audio', 'bgsound', 'marquee', 'video']
        ],
        'low' => [
            'matches' => ['meter']
        ],
        'manifest' => [
            'matches' => ['html']
        ],
        'max' => [
            'matches' => ['input', 'meter', 'progress']
        ],
        'maxlength' => [
            'matches' => ['input', 'textarea']
        ],
        'minlength' => [
            'matches' => ['input', 'textarea']
        ],
        'media' => [
            'matches' => ['a', 'area', 'link', 'source', 'style']
        ],
        'method' => [
            'matches' => ['form']
        ],
        'min' => [
            'matches' => ['input', 'meter']
        ],
        'multiple' => [
            'matches' => ['input', 'select']
        ],
        'muted' => [
            'matches' => ['audio', 'video']
        ],
        'name' => [
            'matches' => ['button', 'form', 'fieldset', 'iframe', 'input', 'keygen', 'object', 'output', 'select', 'textarea', 'map', 'meta', 'param']
        ],
        'novalidate' => [
            'matches' => ['form']
        ],
        'open' => [
            'matches' => ['details']
        ],
        'optimum' => [
            'matches' => ['meter']
        ],
        'pattern' => [
            'matches' => ['input']
        ],
        'ping' => [
            'matches' => ['a', 'area']
        ],
        'placeholder' => [
            'matches' => ['input', 'textarea']
        ],
        'poster' => [
            'matches' => ['video']
        ],
        'preload' => [
            'matches' => ['audio', 'video']
        ],
        'radiogroup' => [
            'matches' => ['command']
        ],
        'readonly' => [
            'matches' => ['input', 'textarea']
        ],
        'rel' => [
            'matches' => ['a', 'area', 'link']
        ],
        'required' => [
            'matches' => ['input', 'select', 'textarea']
        ],
        'reversed' => [
            'matches' => ['ol']
        ],
        'rows' => [
            'matches' => ['textarea']
        ],
        'rowspan' => [
            'matches' => ['td', 'th']
        ],
        'sandbox' => [
            'matches' => ['iframe']
        ],
        'scope' => [
            'matches' => ['th']
        ],
        'scoped' => [
            'matches' => ['style']
        ],
        'seamless' => [
            'matches' => ['iframe']
        ],
        'selected' => [
            'matches' => ['option']
        ],
        'shape' => [
            'matches' => ['a', 'area']
        ],
        'size' => [
            'matches' => ['input', 'select']
        ],
        'sizes' => [
            'matches' => ['link', 'img', 'source']
        ],
        'slot' => [
            'matches' => ['*']
        ],
        'span' => [
            'matches' => ['col', 'colgroup']
        ],
        'spellcheck' => [
            'matches' => ['*']
        ],
        'src' => [
            'matches' => ['audio', 'embed', 'iframe', 'img', 'input', 'script', 'source', 'track', 'video']
        ],
        'srcdoc' => [
            'matches' => ['iframe']
        ],
        'srclang' => [
            'matches' => ['track']
        ],
        'srcset' => [
            'matches' => ['img']
        ],
        'start' => [
            'matches' => ['ol']
        ],
        'step' => [
            'matches' => ['input']
        ],
        'style' => [
            'matches' => ['*']
        ],
        'summary' => [
            'matches' => ['table']
        ],
        'tabindex' => [
            'matches' => ['*']
        ],
        'target' => [
            'matches' => ['a', 'area', 'base', 'form']
        ],
        'title' => [
            'matches' => ['*']
        ],
        'type' => [
            'matches' => ['button', 'input', 'command', 'embed', 'object', 'script', 'source', 'style', 'menu']
        ],
        'usemap' => [
            'matches' => ['img',  'input', 'object']
        ],
        'value' => [
            'matches' => ['button', 'option', 'input', 'li', 'meter', 'progress', 'param']
        ],
        'width' => [
            'matches' => ['canvas', 'embed', 'iframe', 'img', 'input', 'object', 'video']
        ],
        'wrap' => [
            'matches' => ['textarea']
        ],
    ];

    /**
     * TagValidator constructor.
     * @param string $tag
     * @param string $attribute
     */
    public function __construct (string $tag, string $attribute)
    {
        $this->tag = $tag;
        $this->attribute = $attribute;
    }

    /**
     * Static constructor
     * @param string $tag
     * @param string $attribute
     * @return \Aviator\Html\Validators\AttributeValidator
     */
    public static function make (string $tag, string $attribute)
    {
        return new self($tag, $attribute);
    }

    /**
     * Perform the validation.
     * @return bool
     */
    public function validate () : bool
    {
        return $this->isValidAttribute() && $this->isValidAttributeForTag();
    }

    /**
     * Verify that the attribute is a valid attribute.
     * @return bool
     * @throws \Aviator\Html\Exceptions\AttributeDoesNotExist
     */
    protected function isValidAttribute () : bool
    {
        if (!array_key_exists($this->attribute, $this->validAttributes)) {
            throw new AttributeDoesNotExist(
                '"' . $this->attribute . '" is not a valid attribute.'
            );
        }

        return true;
    }

    /**
     * @return bool
     * @throws \Aviator\Html\Exceptions\AttributeDoesNotMatchTag
     */
    protected function isValidAttributeForTag () : bool
    {
        /*
         * Certain attributes may be applied to any tag.
         */
        if ($this->validAttributes[$this->attribute]['matches'] === ['*']) {
            return true;
        }

        if (!in_array($this->tag, $this->validAttributes[$this->attribute]['matches'])) {
            throw new AttributeDoesNotMatchTag(
                '"' . $this->attribute . '" is not a valid attribute for the "' . $this->tag . '" tag.'
            );
        }

        return true;
    }
}
