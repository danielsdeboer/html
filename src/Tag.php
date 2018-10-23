<?php

namespace Aviator\Html;

use Aviator\Delegate\Delegate;
use Aviator\Html\Bags\AttributeBag;
use Aviator\Html\Bags\ClassBag;
use Aviator\Html\Bags\ContentBag;
use Aviator\Html\Exceptions\VoidTagsMayNotHaveContent;
use Aviator\Html\Interfaces\Renderable;
use Aviator\Html\Traits\HasToString;
use Aviator\Html\Validators\TagValidator;

class Tag implements Renderable
{
    use HasToString;

    const HTML_OPEN = '<';
    const HTML_CLOSE = '>';
    const TAG_CLOSE = '/';

    /** @var string */
    protected $name;

    /** @var \Aviator\Html\Bags\ClassBag */
    protected $classes;

    /** @var \Aviator\Html\Bags\AttributeBag */
    protected $attributes;

    /** @var \Aviator\Html\Bags\ContentBag */
    protected $content;

    /** @var bool */
    protected $hasClosingTag;

    /** @var array */
    protected $voids = [
        'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 
        'track', 'wbr',
    ];

    /** @var bool */
    protected $shouldRender;

    /**
     * HtmlNode constructor.
     * @param string $name
     * @param array|string $classes
     * @param array $attributes
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public function __construct (string $name, $classes = [], $attributes = [])
    {
        $this->setName($name);

        $this->attributes = AttributeBag::make($name, $attributes);
        $this->classes = ClassBag::make($classes);
        $this->content = ContentBag::make([]);
        $this->hasClosingTag = true;
    }

    /**
     * Static constructor.
     * @param string $name
     * @param array $classes
     * @param array $props
     * @return \Aviator\Html\Tag
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public static function make (string $name, $classes = [], $props = []): Tag
    {
        return new self($name, $classes, $props);
    }

    /**
     * @param $condition
     * @param string $name
     * @param array $classes
     * @param array $props
     * @return \Aviator\Html\Tag
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public static function when ($condition, string $name, $classes = [], $props = []): Tag
    {
        return Tag::make($name, $classes, $props)
            ->setShouldRender($condition);
    }

    /**
     * @param $condition
     * @return \Aviator\Html\Tag
     */
    public function setShouldRender ($condition): self
    {
        if ($condition) {
            $this->shouldRender = true;
        } else {
            $this->shouldRender = false;
        }

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public function setName (string $name)
    {
        if (TagValidator::make($name)->validate()) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * Get the tag name, eg 'div'
     * @return string
     */
    public function getName () : string
    {
        return $this->name;
    }

    /**
     * @param $content
     * @return $this
     */
    public function addContent ($content)
    {
        $content = $this->asArray($content);

        $this->content->many($content);

        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function addClass ($class)
    {
        $class = $this->asArray($class);

        $this->classes->many($class);

        return $this;
    }

    /**
     * @param $attributes
     * @return $this
     */
    public function addAttribute (array $attributes)
    {
        $this->attributes->many($attributes);

        return $this;
    }

    /**
     * Get an attribute value by name.
     * @param $name
     * @return string|bool|null
     */
    public function attribute ($name)
    {
        /** @var \Aviator\Html\Attribute $attribute */
        $attribute = $this->attributes->get($name);

        return $attribute
            ? $attribute->getValue()
            : null;
    }

    /**
     * @param array|string|\Aviator\Html\Interfaces\Renderable $contents
     * @return $this
     * @throws \Aviator\Html\Exceptions\VoidTagsMayNotHaveContent
     */
    public function with ($contents)
    {
        if ($this->isVoid()) {
            throw new VoidTagsMayNotHaveContent($this->name);
        }

        if (is_array($contents)) {
            $this->content->many($contents);
        } else {
            $this->addContent($contents);
        }

        return $this;
    }

    /**
     * @return \Aviator\Html\Tag
     */
    public function dontClose () : Tag
    {
        return $this->hasClosingTag(false);
    }

    /**
     * @param bool $bool
     * @return \Aviator\Html\Tag
     */
    public function hasClosingTag (bool $bool) : Tag
    {
        $this->hasClosingTag = $bool;

        return $this;
    }

    /**
     * Is the element void (has no closing tag, has no content).
     * @return bool
     */
    public function isVoid () : bool
    {
        return in_array($this->name, $this->voids);
    }

    /**
     * Return a html string representation of the object.
     * @return string
     */
    public function render () : string
    {
        if (isset($this->shouldRender) && !$this->shouldRender) {
            return '';
        }

        if ($this->isVoid()) {
            return $this->open();
        }

        if (!$this->hasClosingTag) {
            return implode('', [
                $this->open(),
                $this->content(),
            ]);
        }

        return implode('', [
           $this->open(),
           $this->content(),
           $this->close(),
        ]);
    }

    /**
     * Render the opening tag.
     * @return string
     */
    protected function open () : string
    {
        return implode('', [
            self::HTML_OPEN,
            $this->openInternal(),
            self::HTML_CLOSE,
        ]);
    }

    /**
     * Get the internal parts of an opening tag.
     * @return string
     */
    protected function openInternal () : string
    {
        return implode(' ', array_filter([
            $this->name,
            $this->classes->render(),
            $this->attributes->render(),
        ]));
    }

    /**
     * @return string
     */
    public function content () : string
    {
        return $this->content->render();
    }

    /**
     * Render the closing tag.
     * @return string
     */
    protected function close () : string
    {
        return implode('', [
            self::HTML_OPEN,
            self::TAG_CLOSE,
            $this->name,
            self::HTML_CLOSE,
        ]);
    }

    /**
     * If the parameter isn't an array, make it one.
     * @param $value
     * @return array
     */
    protected function asArray ($value) : array
    {
        return is_array($value) ? $value : [$value];
    }

    /**
     * Get an attribute delegator.
     * @return Delegate
     */
    protected function attributeDelegator ()
    {
        return new Delegate($this->attributes, function(AttributeBag $items, $name) {
            return $items->value($name);
        });
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get ($name)
    {
        if ($name === 'attributes') {
            return $this->attributeDelegator();
        }

        /*
         * Raise the error as normal otherwise.
         */
        return trigger_error('Undefined property: ' . self::class . '::' . $name);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return \Aviator\Html\Tag
     * @throws \Aviator\Html\Exceptions\ValidationException
     */
    public static function __callStatic ($name, $arguments)
    {
        return new static($name, ...$arguments);
    }
}
