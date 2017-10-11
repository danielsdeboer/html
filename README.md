![travis-badge](https://travis-ci.org/danielsdeboer/html.svg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/aviator/html/v/stable)](https://packagist.org/packages/aviator/html)
[![License](https://poser.pugx.org/aviator/html/license)](https://packagist.org/packages/aviator/html)
# Html

Html is a simple package for building snippets of valid HTML. It can be used to augment a templating system where you want to encapsulate more logic in a class vs a template file. 

## Getting Started
### Prerequisites

This package requires PHP 7 or higher.

### Installing

Via Composer:

```
composer require aviator/html
``` 

### Testing

Run:

```html
composer test
```

## Usage

### Tags

To build a block of HTML, make a new tag:

```php
$tag = new Tag('div');
```

Or, using the static constructor:

```php
$tag = Tag::make('div');
```

To render the tag, call `render()`:

```php
echo $tag->render();
```

Which produces:

```html
<div></div>
```

The `Tag` class will only accept valid HTML tags. Trying to create an invalid tag will throw an exception.

## Content

Tags can have contents. You can pass in a string, a `Tag`, or an array of either or both.

### String

Use the `with()` method to add content to a tag:

```php
$tag = Tag::make('div')->with('some content');
```

This will render as:

```html
<div>some content</div>
```

### Nested Tag

Tags can be nested:

```php
$tag = Tag::make('div')->with(
    Tag::make('p')->with('some content')
);
```

Render:

```html
<div><p>some content</p></div>
```

### Array

You can also use an array:

```php
$tag = Tag::make('ul')->with([
    Tag::make('li')->with('list item 1'),
    Tag::make('li')->with('list item 2'),
    'misplaced text',
]);
```

Which will render:

```html
<ul>
  <li>list item 1</li>
  <li>list item 2</li>
  misplaced text
</ul>
```

### Void tags

The `Tag` class knows which tags are void and need no closing tag. There's no need to do anything for `<input>`, `<hr>`, etc.

Void tags cannot have content. Trying to add content to them will throw an exception.

## Classes

To specify CSS classes for your tags, pass in a second parameter:

```php
$tag = Tag::make('div', 'some-class');
```

Render:

```html
<div class="some-class"></div>
```

Multiple classes may be passed in via array:

```php
$tag = Tag::make('div', ['class-one', 'class-two'])
```

Render:

```html
<div class="class-one class-two"></div>
```

### After instantiation

If you need to add classes after instantiation, you can call `addClass()`, which accepts the same string or array as the constructor:

```php
$tag = Tag::make('div');

$tag->addClass('some-class');
$tag->addClass(['class2', 'class3'])
```

## Attributes

Attributes are passed in as the third parameter. Attributes with values are passed by association. Boolean attributes are simply a value.

```php
$tag = Tag::make('input', 'some-class', [
    'value' => 'content',
    'disabled'
]);
```

Render:

```html
<input value="content" disabled>
```

### After instantiation

If you need to add attributes after instantiation, you can call `addAttribute()`, which accepts the same array as the constructor:

```php
$tag = Tag::make('input');

$tag->addAttribute(['autocomplete' => 'off']);
$tag->addAttribute(['disabled']);
```

### Validation

Attributes are validated to make sure they belong to the tag you've applied them to. For instance adding the `max` attribute to a `<div>` will throw an exception.


