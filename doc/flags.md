# Flags

## `->directory`
Sets the `directory` flag, and indicates that the assertions following in the chain target a directory:

```php
expect($path)->directory->to->be->writable;
```

## `->file`
Sets the `file` flag, and indicates that the assertions following in the chain target a file:

```php
expect($path)->file->to->be->readable;
```

## `->json`
Sets the `json` flag, and indicates that the assertions following in the chain target a [JSON](http://www.json.org) document:

```php
TODO
```

## `->length`
> Alias: `->lengthOf`

Sets the `length` flag, and indicates that the assertions following in the chain target a length:

```php
expect('foo')->to->have->length->above(2);
expect([1, 2, 3])->to->have->length->below(4);
expect('foo')->to->have->length->of->at->least(3);
expect([1, 2, 3])->to->have->length->of->at->most(3);
expect('foo')->to->have->length->within(2, 4);
```

## `->not`
Sets the `negate` flag, and negates any of assertions following in the chain:

```php
expect($foo)->to->not->equal('bar');
expect($goodFn)->to->not->throw;
```

## `->ordered`
Sets the `ordered` flag, later used by the `members` assertions:

```php
TODO
```

## `->xml`
Sets the `xml` flag, and indicates that the assertions following in the chain target an [XML](https://www.w3.org/XML) document:

```php
TODO
```
