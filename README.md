# Html

Html is a simple package for building snippets of valid HTML. It can be used to augment a templating system where you want to encapsulate more logic in a class vs a template file. 

## Getting Started
### Prerequisites

This package requires PHP 7 or higher.

### Installing

Install via composer with:

```
composer require aviator/html
``` 

## Usage

### Tags

To build a block of HTML, simple make a new tag:

```php
$tag = new Tag('div');
```

or using the static constructor:

```php
$tag = Tag::make('div');
```

To render the tag, call `render()`:

```php
echo $tag->render();
```

which will produce:

```html
<div></div>
```

Only valid HTML tags can be created. Creating an invalid tag will throw an exception.

## Content

Tags can have content, either a string or another tag (which can in turn have its own content).

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

Void tags (`<input>`, `<hr>`, etc) cannot have content. Trying to add content to them will throw an exception.

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

## Attributes

Attributes are passed in as the third parameter. Attributes with values are passed by key => value, with boolean attributes simply a value.

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

### Validation

Attributes are validated to make sure they belong to the tag you've applied them to. For instance adding the `max` attribute to a `<div>` will throw an exception.


